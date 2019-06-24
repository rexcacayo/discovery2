<?php

namespace App\Http\Controllers\Frontend;

use App\Tarjeta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TarjetasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tarjetas = Tarjeta::query();
        $tarjetas = $tarjetas->paginate(20);
        return view('frontend.tarjetas.index')->with('tarjetasData', $tarjetas);
    }
}
