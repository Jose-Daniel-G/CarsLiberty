<?php

namespace App\Http\Controllers\News;
use App\Http\Controllers\Controller;

use App\Models\File;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

// use Spatie\Permission\Contracts\Role;

class SettingsController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('settings.index', compact('users', 'roles'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email-modal' => 'required|email|unique:users,email|string|max:255',
            'photo-modal' => 'required|image|max:2048',
            'password' => 'required',
            'password-confirm' => 'required|same:password',
        ]);
        $user = new User();


        $user->name = $request->nombre;
        $user->email =  $request->input('email-modal');
        $user->password = Hash::make($request->password);
        // UPLOAD IMAGES
        $file = $request->file('photo-modal');
        if (!empty($file)) {
            $nombre =  time() . "_" . $file->getClientOriginalName();
            $imagen = $request->file('photo-modal')->storeAs('public/uploads', $nombre);
            $url = Storage::url($imagen);
            $user->save();

            $imagen_id = $user->getKey(); // Obtener el ID del modelo "Post" después de guardarlo en la base de datos

            Image::create(['url' => $url, 'imageable_id' => $imagen_id, 'imageable_type' => User::class]);
 
        } else {
            $user->save();
        }
        return back()->with('message', 'User Created');
    } 
    public function show($id)
    {
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->img_user = $request->img_user;

        $user->save();
        return redirect()->route('settings.index');
    }

    public function destroy($id)
    {
        //
    }
}
