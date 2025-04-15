<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Curso;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::with('user')->get();
        return view('admin.clientes.index', compact('clientes'));
    }

    public function create()
    {
        $cursos = Curso::all();
        return view('admin.clientes.create', compact('cursos'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'cc' => 'required|max:11|unique:clientes,cc',
            'genero' => 'required',
            'celular' => 'required|max:11',
            'correo' => 'required|email|max:250|unique:users,email',
            'direccion' => 'required',
            'contacto_emergencia' => 'required|max:11',
        ]);
    
        try {      
            $usuario = User::create([
                'name' => $request->nombres,
                'email' => $request->correo,
                'password' => Hash::make($request->password ?? $request->cc),
            ]);
    
            $usuario->assignRole('cliente');
    
            // Asociar el user_id al cliente
            $validatedData['user_id'] = $usuario->id;
    
            // Crear cliente
            $cliente = Cliente::create($validatedData);
    
            // Asignar cursos si existen
            if ($request->has('cursos') && is_array($request->cursos)) {
                foreach ($request->cursos as $cursoId) {
                    $cliente->cursos()->attach($cursoId, ['horas_realizadas' => 0]);
                }
            }
    
            return redirect()->route('admin.clientes.index')
                ->with(['title' => 'Éxito', 'info' => 'Se registró al Cliente de forma correcta', 'icono' => 'success']);
    
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->withErrors(['correo' => 'El correo ya está en uso. Por favor, utiliza otro.'])->withInput();
            }
            \Log::error('Error de base de datos al registrar cliente: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Error en la base de datos.'])->withInput();
    
        } catch (\Exception $e) {
            \Log::error('Error inesperado al registrar cliente: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Ocurrió un error inesperado.'])->withInput();
        }
    }
    

    public function show(Cliente $cliente)
    {
        return view('admin.clientes.show', compact('cliente'));
    }


    public function edit(Cliente $cliente)
    {
        $cursos = Curso::all(); // Cargar todos los cursos disponibles

        // Obtener los IDs de los cursos ya asignados al cliente
        $cursosSeleccionados = $cliente->cursos->pluck('id')->toArray();

        return view('admin.clientes.edit', compact('cliente', 'cursos', 'cursosSeleccionados'));
    }


    public function update(Request $request, Cliente $cliente)
    {
        $validatedData = $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'cc' => 'required|unique:clientes,cc,' . $cliente->id,
            'genero' => 'required',
            'celular' => 'required',
            'correo' => 'required|email|max:250|unique:clientes,correo,' . $cliente->id,
            'direccion' => 'required',
            'contacto_emergencia' => 'required',
            // 'fecha_nacimiento' => 'required',
        ]);
        // $validatedData['fecha_nacimiento'] = Carbon::createFromFormat('Y-m-d', $request->fecha_nacimiento)->format('d/m/Y');

        if ($request->has('reset_password')) { //Si el checkbox está marcado, Restablecer la contraseña a la cédula
            $usuario = User::find($cliente->user_id); //dd($cliente->user_id);
            $usuario->password = Hash::make($request->cc); // Establecer la contraseña a la cédula
            $usuario->save();
        }

        // Actualizar los datos del Cliente
        $cliente->update($validatedData);

        $cliente->cursos()->sync($request->cursos ?? []); // Sincroniza los cursos seleccionados en el formulario

        return redirect()->route('admin.clientes.index')
            ->with(['title', 'Exito', 'info', 'Cliente actualizado correctamente.', 'icono', 'success']);
    }

    public function toggleStatus($id) //DEACTIVATE
    {
        $user = User::findOrFail($id);
        $user->status = !$user->status;
        $user->save();
    
        return redirect()->back()->with('success', 'Estado del usuario actualizado.');
    }

    // public function destroy(Cliente $Cliente)
    // {
    //     if ($Cliente->user) {// Si existe un usuario asociado, eliminarlo
    //         $Cliente->user->delete(); 
    //     }
    //     // Eliminar el Cliente
    //     $Cliente->delete();

    //     return redirect()->route('admin.clientes.index')
    //         ->with(['title', 'Exito', 'info', 'El Cliente se eliminó con éxito', 'icono', 'success']);
    // }
}
