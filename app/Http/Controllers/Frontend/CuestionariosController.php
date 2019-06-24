<?php

namespace App\Http\Controllers\Frontend;

use App\Cuestionario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CuestionariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cuestionarios = Cuestionario::query();
        $cuestionarios = $cuestionarios->paginate(20);
        return view('frontend.cuestionarios.index')->with('cuestionariosData', $cuestionarios);
    }
}
