<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\File;
use App\Models\User;
use App\Models\Category;
use App\Models\Image;
use App\Models\Post;

class PostController extends Controller
{
    public function template()
    {
        $posts = Post::select('*')->join('images', 'posts.id', '=', 'images.imageable_id')
            ->where('imageable_type', '=', Post::class)
            ->orderBy('posts.id', 'desc')->get(); // comienza desde el ultimo post

        return view('welcome', compact('posts'));
    }
    public function index()
    {
        $categories = Category::all();
        $posts = Post::all();
        return view('news.posts.index', compact('posts', 'categories'));
    }
    public function show(Post $post)
    {
        $similares = Post::where('category_id', $post->category_id)
            ->where('status', 2)
            ->where('id', '!=', $post->id)
            ->latest('id')
            ->take(4)
            ->get();
        return view('posts.show', compact('post', 'similares'));
    }

    public function edit($id) {}
    public function update(Request $request, $id) {}
    public function create() {}

    public function store(Request $request)
    { // se ha cambiado el tamano max:2048 a 40960 
        $request->validate(['foto' => 'required|image|max:40960', 'category_id' => 'required']);

        $post = new Post();
        $post->title = $request->txtTitulo;
        $post->slug = Str::slug($request->txtTitulo);
        $post->body = $request->txtDescripcion;
        $post->user_id = Auth::user()->id;
        $post->category_id = $request->category_id;

        $post->save();

        $imagen_id = $post->getKey();                   // El ID del  "Post" después de crearlo 

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nombre = time() . "_" . $file->getClientOriginalName();
            $ruta = $file->storeAs('uploads', $nombre); // $ruta = $file->store('uploads', 'public');
            $url = 'storage/' . $ruta;

            Image::create(['url' => $url, 'imageable_id' => $imagen_id, 'imageable_type' => Post::class]); // $post->image()->create(['url' => $url]);
        } 

        return redirect()->back()->with('success', 'New Created succesfully');
    }
    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->back()->with('error', "Publicación con id $id no encontrada");
        }
        
        if ($post->image) {              // Borrar imagen asociada
            $path = str_replace('storage/', '', $post->image->url);
            Storage::disk('public')->delete($path);
            $post->image->delete();
        }
        
        $post->tags()->detach();          // Opcional: detach tags si quieres limpiar pivot

        $post->delete();

        return redirect()->back()->with('success', 'Publicación eliminada correctamente');
    }
}
