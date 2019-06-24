<?php

namespace App\Http\Controllers\Frontend;

use App\Acompanante;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AcompanantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $acompanantes = Acompanante::query();
        $acompanantes = $acompanantes->paginate(20);
        return view('frontend.acompanantes.index')->with('acompanantesData', $acompanantes);
    }
}
