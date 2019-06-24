<?php

namespace App\Http\Controllers\Backend;

use App\Parametro;
use Illuminate\Http\Request;
use Shahnewaz\Redprint\Traits\CanUpload;
use App\Http\Requests\Backend\ParametroRequest;
use App\Http\Controllers\Controller;

class ParametrosController extends Controller
{
    use CanUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $parametros = Parametro::withTrashed();
        
        $parametros = $parametros->paginate(20);
        return view('backend.parametros.index')->with('parametrosData', $parametros);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form(Parametro $parametro = null)
    {
        $parametro = $parametro ?: new Parametro;
		$preguntas = \App\Pregunta::pluck('pregunta', 'id')->toArray();
		return view('backend.parametros.form')->with('parametro', $parametro)->with('preguntas', $preguntas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(ParametroRequest $request, Parametro $parametro)
    {
        $parametro = Parametro::firstOrNew(['id' => $request->get('id')]);
        $parametro->id = $request->get('id');
		$parametro->formulario = $request->get('formulario');
		$parametro->tipopregunta = $request->get('tipopregunta');

$parametro->pregunta_id = $request->get('pregunta_id');
        $parametro->save();

        $message = trans('redprint::core.model_added', ['name' => 'parametro']);
        return redirect()->route('parametro.index')->withMessage($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Parametro $parametro)
    {
        $parametro->delete();
        $message = trans('redprint::core.model_deleted', ['name' => 'parametro']);
        return redirect()->back()->withMessage($message);
    }

    /**
     * Restore the specified deleted resource to storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($parametroId)
    {
        $parametro = Parametro::withTrashed()->find($parametroId);
        $parametro->restore();
        $message = trans('redprint::core.model_restored', ['name' => 'parametro']);
        return redirect()->back()->withMessage($message);
    }

    public function forceDelete($parametroId)
    {
        $parametro = Parametro::withTrashed()->find($parametroId);
        $parametro->forceDelete();
        $message = trans('redprint::core.model_permanently_deleted', ['name' => 'parametro']);
        return redirect()->back()->withMessage($message);
    }
}
