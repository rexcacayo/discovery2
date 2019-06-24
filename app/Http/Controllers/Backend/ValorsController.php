<?php

namespace App\Http\Controllers\Backend;

use App\Valor;
use Illuminate\Http\Request;
use Shahnewaz\Redprint\Traits\CanUpload;
use App\Http\Requests\Backend\ValorRequest;
use App\Http\Controllers\Controller;

class ValorsController extends Controller
{
    use CanUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $valors = Valor::withTrashed()->orderBy('pregunta_id', 'ASC');
        
        $valors = $valors->paginate(20);
        return view('backend.valors.index')->with('valorsData', $valors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form(Valor $valor = null)
    {
        $valor = $valor ?: new Valor;
        $preguntas = \App\Pregunta::whereNotIn('tipo', ['number','text'])
            ->pluck('pregunta', 'id')->toArray();
        return view('backend.valors.form')->with('valor', $valor)->with('preguntas', $preguntas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(ValorRequest $request, Valor $valor)
    {
        $valor = Valor::firstOrNew(['id' => $request->get('id')]);
        $valor->id = $request->get('id');
        $valor->valor = $request->get('valor');

        $valor->pregunta_id = $request->get('pregunta_id');
        $valor->save();

        $message = trans('redprint::core.model_added', ['name' => 'valor']);
        return redirect()->route('valor.index')->withMessage($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Valor $valor)
    {
        $valor->delete();
        $message = trans('redprint::core.model_deleted', ['name' => 'valor']);
        return redirect()->back()->withMessage($message);
    }

    /**
     * Restore the specified deleted resource to storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($valorId)
    {
        $valor = Valor::withTrashed()->find($valorId);
        $valor->restore();
        $message = trans('redprint::core.model_restored', ['name' => 'valor']);
        return redirect()->back()->withMessage($message);
    }

    public function forceDelete($valorId)
    {
        $valor = Valor::withTrashed()->find($valorId);
        $valor->forceDelete();
        $message = trans('redprint::core.model_permanently_deleted', ['name' => 'valor']);
        return redirect()->back()->withMessage($message);
    }
}
