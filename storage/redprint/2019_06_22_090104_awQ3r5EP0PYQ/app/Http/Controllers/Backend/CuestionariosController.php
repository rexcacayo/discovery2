<?php

namespace App\Http\Controllers\Backend;

use App\Cuestionario;
use Illuminate\Http\Request;
use Shahnewaz\Redprint\Traits\CanUpload;
use App\Http\Requests\Backend\CuestionarioRequest;
use App\Http\Controllers\Controller;

class CuestionariosController extends Controller
{
    use CanUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cuestionarios = Cuestionario::withTrashed();
        
        $cuestionarios = $cuestionarios->paginate(20);
        return view('backend.cuestionarios.index')->with('cuestionariosData', $cuestionarios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form(Cuestionario $cuestionario = null)
    {
        $cuestionario = $cuestionario ?: new Cuestionario;
        return view('backend.cuestionarios.form')->with('cuestionario', $cuestionario);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(CuestionarioRequest $request, Cuestionario $cuestionario)
    {
        $cuestionario = Cuestionario::firstOrNew(['id' => $request->get('id')]);
        $cuestionario->id = $request->get('id');
		$cuestionario->respuesta = $request->get('respuesta');
		$cuestionario->formulario = $request->get('formulario');

        $cuestionario->save();

        $message = trans('redprint::core.model_added', ['name' => 'cuestionario']);
        return redirect()->route('cuestionario.index')->withMessage($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Cuestionario $cuestionario)
    {
        $cuestionario->delete();
        $message = trans('redprint::core.model_deleted', ['name' => 'cuestionario']);
        return redirect()->back()->withMessage($message);
    }

    /**
     * Restore the specified deleted resource to storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($cuestionarioId)
    {
        $cuestionario = Cuestionario::withTrashed()->find($cuestionarioId);
        $cuestionario->restore();
        $message = trans('redprint::core.model_restored', ['name' => 'cuestionario']);
        return redirect()->back()->withMessage($message);
    }

    public function forceDelete($cuestionarioId)
    {
        $cuestionario = Cuestionario::withTrashed()->find($cuestionarioId);
        $cuestionario->forceDelete();
        $message = trans('redprint::core.model_permanently_deleted', ['name' => 'cuestionario']);
        return redirect()->back()->withMessage($message);
    }
}
