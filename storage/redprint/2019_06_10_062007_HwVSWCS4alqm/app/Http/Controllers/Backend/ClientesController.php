<?php

namespace App\Http\Controllers\Backend;

use App\Cliente;
use Illuminate\Http\Request;
use Shahnewaz\Redprint\Traits\CanUpload;
use App\Http\Requests\Backend\ClienteRequest;
use App\Http\Controllers\Controller;

class ClientesController extends Controller
{
    use CanUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clientes = Cliente::withTrashed();
        
        $clientes = $clientes->paginate(20);
        return view('backend.clientes.index')->with('clientesData', $clientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form(Cliente $cliente = null)
    {
        $cliente = $cliente ?: new Cliente;
        return view('backend.clientes.form')->with('cliente', $cliente);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(ClienteRequest $request, Cliente $cliente)
    {
        $cliente = Cliente::firstOrNew(['id' => $request->get('id')]);
        $cliente->id = $request->get('id');
		$cliente->fecha = $request->get('fecha');
		$cliente->nombreSr = $request->get('nombreSr');
		$cliente->cedulaSr = $request->get('cedulaSr');
		$cliente->edadSr = $request->get('edadSr');
		$cliente->ocupacionSr = $request->get('ocupacionSr');
		$cliente->nombreSra = $request->get('nombreSra');
		$cliente->cedulaSra = $request->get('cedulaSra');
		$cliente->edadSra = $request->get('edadSra');
		$cliente->ocupacionSra = $request->get('ocupacionSra');
		$cliente->estadoCivil = $request->get('estadoCivil');
		$cliente->ingreso = $request->get('ingreso');
		$cliente->telCasa = $request->get('telCasa');
		$cliente->direccion = $request->get('direccion');
		$cliente->correo = $request->get('correo');
		$cliente->lugaresContactaron = $request->get('lugaresContactaron');
		$cliente->propiedad = $request->get('propiedad');
		$cliente->opc = $request->get('opc');
		$cliente->liner = $request->get('liner');
		$cliente->hostess = $request->get('hostess');
		if ($request->file('cvs')) {
			$cliente->cvs = $this->upload($request->file('cvs'), 'clientes')->getFileName();
		} else {
			$cliente->cvs = $cliente->cvs;
		}

        $cliente->save();

        $message = trans('redprint::core.model_added', ['name' => 'cliente']);
        return redirect()->route('cliente.index')->withMessage($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Cliente $cliente)
    {
        $cliente->delete();
        $message = trans('redprint::core.model_deleted', ['name' => 'cliente']);
        return redirect()->back()->withMessage($message);
    }

    /**
     * Restore the specified deleted resource to storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($clienteId)
    {
        $cliente = Cliente::withTrashed()->find($clienteId);
        $cliente->restore();
        $message = trans('redprint::core.model_restored', ['name' => 'cliente']);
        return redirect()->back()->withMessage($message);
    }

    public function forceDelete($clienteId)
    {
        $cliente = Cliente::withTrashed()->find($clienteId);
        $cliente->forceDelete();
        $message = trans('redprint::core.model_permanently_deleted', ['name' => 'cliente']);
        return redirect()->back()->withMessage($message);
    }
}
