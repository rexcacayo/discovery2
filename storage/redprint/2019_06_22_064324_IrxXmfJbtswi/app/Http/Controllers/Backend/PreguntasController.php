<?php

namespace App\Http\Controllers\Backend;

use App\Pregunta;
use Illuminate\Http\Request;
use Shahnewaz\Redprint\Traits\CanUpload;
use App\Http\Requests\Backend\PreguntaRequest;
use App\Http\Controllers\Controller;

class PreguntasController extends Controller
{
    use CanUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $preguntas = Pregunta::withTrashed();
        
        $preguntas = $preguntas->paginate(20);
        return view('backend.preguntas.index')->with('preguntasData', $preguntas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form(Pregunta $pregunta = null)
    {
        $pregunta = $pregunta ?: new Pregunta;
        return view('backend.preguntas.form')->with('pregunta', $pregunta);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(PreguntaRequest $request, Pregunta $pregunta)
    {
        $pregunta = Pregunta::firstOrNew(['id' => $request->get('id')]);
        $pregunta->id = $request->get('id');
		$pregunta->pregunta = $request->get('pregunta');
		$pregunta->formulario = $request->get('formulario');
		$pregunta->tipo = $request->get('tipo');

        $pregunta->save();

        $message = trans('redprint::core.model_added', ['name' => 'pregunta']);
        return redirect()->route('pregunta.index')->withMessage($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Pregunta $pregunta)
    {
        $pregunta->delete();
        $message = trans('redprint::core.model_deleted', ['name' => 'pregunta']);
        return redirect()->back()->withMessage($message);
    }

    /**
     * Restore the specified deleted resource to storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($preguntaId)
    {
        $pregunta = Pregunta::withTrashed()->find($preguntaId);
        $pregunta->restore();
        $message = trans('redprint::core.model_restored', ['name' => 'pregunta']);
        return redirect()->back()->withMessage($message);
    }

    public function forceDelete($preguntaId)
    {
        $pregunta = Pregunta::withTrashed()->find($preguntaId);
        $pregunta->forceDelete();
        $message = trans('redprint::core.model_permanently_deleted', ['name' => 'pregunta']);
        return redirect()->back()->withMessage($message);
    }
}
