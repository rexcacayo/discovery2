<?php

namespace App\Http\Controllers\Frontend;

use App\Pregunta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PreguntasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $preguntas = Pregunta::query();
        $preguntas = $preguntas->paginate(20);
        return view('frontend.preguntas.index')->with('preguntasData', $preguntas);
    }
}
