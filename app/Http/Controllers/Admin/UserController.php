<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('can:admin.user.index')->only('index');
    //     $this->middleware('can:admin.user.edit')->only('edit', 'update');
    // }
    public function index()
    {
        // $usuarios = User::all();
        // return view('admin.users.index', compact('usuarios'));
        return view('admin.users.index');
    }
    public function create()
    {
        // return view('admin.usuarios.create');
    }
    public function store(Request $request)
    {
        // $datos = $request->all();
        // return response()->json($datos);
        // $request->validate([
        //     'name' => 'required|max:250',
        //     'email' => 'required|email|max:250|unique:users',
        //     'password' => 'required|min:8|max:250|confirmed',
        // ]);

        // $usuario = new User();
        // $usuario->name = $request->name;
        // $usuario->email = $request->email;
        // $usuario->password = Hash::make($request->password);
        // $usuario->save();
        // return redirect()->route('admin.users.index')
        //     ->with('info','Se registro al usuario de forma correcta')
        //     ->with('icono','success');
    }
    public function show($id)
    {
        //
    }
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);
        return redirect()->route('admin.users.edit', $user)->with('info', 'Se asigno los roles correctamente');
        // // dd($request->all());
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|max:255',
        //     'password' => 'nullable|max:255|confirmed',
        // ]);

        // $usuario->name = $request->name;
        // $usuario->email = $request->email;
        // if ($request->filled('password')) {
        //     $usuario->password = Hash::make($request['password']); //bcrypt($request->input('password'));
        // }
        // $usuario->save();

        // return redirect()->route('admin.users.index')->with('info', 'Usuario actualizado exitosamente')
        //                                                 ->with('icono','success');
    }

    public function destroy($id)
    {
        // $usuario->delete();
        $user = User::findOrFail($id);

        $user->delete();
        return redirect()->route('admin.users.index')
        ->with('title', 'Exito')
        ->with('info', 'La usuario se eliminó con éxito')->with('icono', 'success');
    }
}
