<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Event;
use App\Models\Horario;
use App\Models\Web;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    public function index()
    { $cursos = Curso::all(); return view('index', compact('cursos')); }

    public function show(Web $web)
    {
        //
    }

    public function edit(Web $web)
    {
        //
    }

    public function update(Request $request, Web $web)
    {
        //
    }

    public function destroy(Web $web)
    {
        //
    }
}
