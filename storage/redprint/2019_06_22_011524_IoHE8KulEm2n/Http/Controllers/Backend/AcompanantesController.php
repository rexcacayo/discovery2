<?php

namespace App\Http\Controllers\Backend;

use App\Acompanante;
use Illuminate\Http\Request;
use Shahnewaz\Redprint\Traits\CanUpload;
use App\Http\Requests\Backend\AcompananteRequest;
use App\Http\Controllers\Controller;

class AcompanantesController extends Controller
{
    use CanUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $acompanantes = Acompanante::query();
        
        $acompanantes = $acompanantes->paginate(20);
        return view('backend.acompanantes.index')->with('acompanantesData', $acompanantes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form(Acompanante $acompanante = null)
    {
        $acompanante = $acompanante ?: new Acompanante;
		$clientes = \App\Cliente::pluck('fecha', 'id')->toArray();
		return view('backend.acompanantes.form')->with('acompanante', $acompanante)->with('clientes', $clientes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(AcompananteRequest $request, Acompanante $acompanante)
    {
        $acompanante = Acompanante::firstOrNew(['id' => $request->get('id')]);
        $acompanante->id = $request->get('id');
        $acompanante->nombre = $request->get('nombre');
        $acompanante->cedula = $request->get('cedula');
        $acompanante->edad = $request->get('edad');
        $acompanante->qsco = $request->get('qsco');
        $acompanante->ocupacion = $request->get('ocupacion');

$acompanante->cliente_id = $request->get('cliente_id');
        $acompanante->save();

        $message = trans('redprint::core.model_added', ['name' => 'acompanante']);
        return redirect()->route('acompanante.index')->withMessage($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Acompanante $acompanante)
    {
        $acompanante->delete();
        $message = trans('redprint::core.model_deleted', ['name' => 'acompanante']);
        return redirect()->back()->withMessage($message);
    }
}
