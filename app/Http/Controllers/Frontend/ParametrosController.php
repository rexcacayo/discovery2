<?php

namespace App\Http\Controllers\Frontend;

use App\Parametro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParametrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $parametros = Parametro::query();
        $parametros = $parametros->paginate(20);
        return view('frontend.parametros.index')->with('parametrosData', $parametros);
    }
}
