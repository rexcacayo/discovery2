<?php

namespace App\Http\Controllers\Frontend;

use App\Valor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ValorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $valors = Valor::query();
        $valors = $valors->paginate(20);
        return view('frontend.valors.index')->with('valorsData', $valors);
    }
}
