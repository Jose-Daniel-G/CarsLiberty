<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('admin.profile.index', compact('user'));
    }
    public function show()
    {
        return view('admin.profile.show');
    }
    public function update(Request $request)
    {  //dd($request->all());
        $user = Auth::user();
        $request->validate([
            'photo' => 'nullable|image|max:2048', // Aseguramos que es opcional
        ]);

        // Subir foto de perfil si viene en el request
        if ($request->hasFile('photo')) {
            // Borrar foto anterior si existe
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            $path = $request->file('photo')->store('profile_photos', 'public');
            $user->profile_photo_path = $path;
        }

        // Actualizar nombre y email
        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return redirect()->back()->with('success', 'Perfil actualizado correctamente.');
    }


    public function updatePassword(Request $request)
    {
        // 1. Validar la solicitud
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        // 2. Verificar que la contraseña actual sea correcta
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta.']);
        }

        // 3. Actualizar la contraseña
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Contraseña actualizada correctamente.');
    }
}
