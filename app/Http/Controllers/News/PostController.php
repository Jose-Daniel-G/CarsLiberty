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
         $posts = Post::select('*')->join('images','posts.id','=','images.imageable_id')
                                  ->where('imageable_type','=', Post::class)
                                  ->orderBy('posts.id','desc')->get(); // comienza desde el ultimo post

        return view('welcome', compact('posts'));
    }
    public function index()
    {
        $categories = Category::all();
        return view('news.posts.index', compact('categories'));
    }
    // public function index(){$categories = Category::all();return view('news.index', ['categories' => $categories]);}
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

    public function edit($id){}
    public function update(Request $request, $id){}
    public function destroy($id){}
    public function create(){}

    public function store(Request $request)
    {
        $request->validate(['foto' => 'required|image|max:2048', 'category_id' => 'required']);

        $post = new Post();
        $post->title = $request->txtTitulo;
        $post->slug = Str::slug($request->txtTitulo);
        $post->body = $request->txtDescripcion;
        $post->user_id = Auth::user()->id;
        $post->category_id = $request->category_id;

        $file = $request->file('foto');
        $nombre =  time() . "_" . $file->getClientOriginalName();
        $imagenes = $request->file('foto')->storeAs('public/uploads', $nombre);
        $url = Storage::url($imagenes);
        
        $post->save();

        $imagen_id = $post->getKey(); // Obtener el ID del modelo "Post" después de guardarlo en la base de datos
        // dd('post', $imagen_id);
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nombre = time() . "_" . $file->getClientOriginalName();
            $ruta = $file->store('uploads', 'public');
            $url = 'storage/' . $ruta;

            Image::create(['url' => $url,'imageable_id' => $imagen_id,'imageable_type' => Post::class]);// $post->image()->create(['url' => $url]);

        } else {
            
            $post->image()->create(['url' => 'storage/uploads/default.jpg']);// Imagen por defecto
        }


        return redirect()->route('posts.index')->with('success', 'New Created succesfully');
    }
}
