<?php

namespace App\Http\Controllers\Frontend;

use App\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clientes = Cliente::query();
        $clientes = $clientes->paginate(20);
        return view('frontend.clientes.index')->with('clientesData', $clientes);
    }
}
