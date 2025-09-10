<?php

namespace App\Http\Controllers;

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
        // dd($request);
        $request->validate([
            'nombre' => 'required',
            'email-modal' => 'required|email|unique:users,email|string|max:255',
            'photo-modal' => 'required|image|max:2048',
            'password' => 'required',
            'password-confirm' => 'required|same:password',
            // 'rol' => 'required'
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
            // $nombre =  time() . "_" . $file->getClientOriginalName();
            // $imagenes = $file->storeAs('public/uploads', $nombre);
            // $url = Storage::url($imagenes);
            // File::create(['url' => $url]);
            // $user->photo = $url;
        } else {
            $user->save();
        }
        return back()->with('message', 'User Created');
    }
    // public function store(StoreContact $request)
    // {
    //     $correo = new ContactanosMailable($request->all());
    //     Mail::to("jose.jdgo97@gmail.com")->send($correo);
    //     return redirect()->route('contactanos.index')->with('info', 'Mensaje enviado');
    // }
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
