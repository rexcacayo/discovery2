<?php

namespace App\Http\Controllers\Backend;

use App\Tarjeta;
use Illuminate\Http\Request;
use Shahnewaz\Redprint\Traits\CanUpload;
use App\Http\Requests\Backend\TarjetaRequest;
use App\Http\Controllers\Controller;

class TarjetasController extends Controller
{
    use CanUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tarjetas = Tarjeta::withTrashed();
        
        $tarjetas = $tarjetas->paginate(20);
        return view('backend.tarjetas.index')->with('tarjetasData', $tarjetas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form(Tarjeta $tarjeta = null)
    {
        $tarjeta = $tarjeta ?: new Tarjeta;
        $clientes = \App\Cliente::pluck('NombreSr', 'id')->toArray();
        return view('backend.tarjetas.form')->with('tarjeta', $tarjeta)->with('clientes', $clientes)->with('clientes', $clientes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(TarjetaRequest $request, Tarjeta $tarjeta)
    {
        $tarjeta = Tarjeta::firstOrNew(['id' => $request->get('id')]);
        $tarjeta->id = $request->get('id');
        $tarjeta->descripcion = $request->get('descripcion');
        $tarjeta->tipo = $request->get('tipo');
        $tarjeta->cantidad = $request->get('cantidad');
        $tarjeta->pertenece = $request->get('pertenece');
        $tarjeta->cliente_id = $request->get('cliente_id');
        $tarjeta->save();
        $message = trans('redprint::core.model_added', ['name' => 'tarjeta']);
        return redirect()->route('tarjeta.index')->withMessage($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Tarjeta $tarjeta)
    {
        $tarjeta->delete();
        $message = trans('redprint::core.model_deleted', ['name' => 'tarjeta']);
        return redirect()->back()->withMessage($message);
    }

    /**
     * Restore the specified deleted resource to storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($tarjetaId)
    {
        $tarjeta = Tarjeta::withTrashed()->find($tarjetaId);
        $tarjeta->restore();
        $message = trans('redprint::core.model_restored', ['name' => 'tarjeta']);
        return redirect()->back()->withMessage($message);
    }

    public function forceDelete($tarjetaId)
    {
        $tarjeta = Tarjeta::withTrashed()->find($tarjetaId);
        $tarjeta->forceDelete();
        $message = trans('redprint::core.model_permanently_deleted', ['name' => 'tarjeta']);
        return redirect()->back()->withMessage($message);
    }
}
