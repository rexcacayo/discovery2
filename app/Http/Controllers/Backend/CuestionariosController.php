<?php

namespace App\Http\Controllers\Backend;

use App\Cuestionario;
use Illuminate\Http\Request;
use Shahnewaz\Redprint\Traits\CanUpload;
use App\Http\Requests\Backend\CuestionarioRequest;
use App\Http\Controllers\Controller;
use App\Cliente;

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
        $clientes = Cliente::withTrashed()->where('recorrido','0');
        $clientes = $clientes->paginate(20);
        return view('backend.cuestionarios.index')->with('cuestionariosData', $clientes);
        /*$cuestionarios = Cuestionario::withTrashed();
        
        $cuestionarios = $cuestionarios->paginate(20);*/
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form(Cuestionario $cuestionario = null)
    {
        $cuestionario = $cuestionario ?: new Cuestionario;
        $preguntas = \App\Pregunta::pluck('pregunta', 'id')->toArray();
        $clientes = \App\Cliente::pluck('fecha', 'id')->toArray();
        return view('backend.cuestionarios.form')->with('cuestionario', $cuestionario)->with('preguntas', $preguntas)->with('clientes', $clientes);
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

        $cuestionario->pregunta_id = $request->get('pregunta_id');
        $cuestionario->cliente_id = $request->get('cliente_id');
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

    public function cuestionario($id)
    {
        $cliente = Cliente::find($id);
        $formulario = 'formulario1';
        $preguntas = \App\Pregunta::where('formulario', $formulario)->paginate(1);
        $pregunta_tipo = $preguntas->all();
        if($pregunta_tipo[0]->tipo !== "text" || $pregunta_tipo[0]->tipo !== "number"){
            $idpre = $preguntas[0]->id;
        }else{
            $idpre = 2;
        }
        $valores = \App\Valor::where('pregunta_id',$idpre)->get();
        
        return view('backend.cuestionarios.respuestas')
            ->with('preguntasData', $preguntas)->with('cliente',$cliente)
            ->with('formulario',$formulario)
            ->with('valores', $valores);  
    }

    public function guardarrespuesta(CuestionarioRequest $request)
    {
        
        $cliente = Cliente::find($request->cliente_id);
        $formulario = 'formulario1';
        $preguntas = \App\Pregunta::where('formulario', $formulario)->paginate();
        $final = strval(count($preguntas));
        $idpre = 1 + $request->id;
        $valores = \App\Valor::where('pregunta_id', $idpre)->get();
        if($request->id){
            $preguntas = $preguntas[$request->id]; 
            if($request->id !== $final)
            {
                if(is_array ( $request->respuesta )){
                    
                    $cadena = implode($request->respuesta);
                    $resultado = str_replace(" ", ",", $cadena);
                    $request->respuesta = $resultado;
                } 
                $cuestionario = new Cuestionario;
                $cuestionario->cliente_id = $request->cliente_id;
                $cuestionario->pregunta_id = $request->id;
                $cuestionario->formulario = $formulario;
                $cuestionario->respuesta = $request->respuesta;
                $cuestionario->save();
                return view('backend.cuestionarios.step')->with('preguntasData', $preguntas)
                    ->with('cliente',$cliente)->with('valores',$valores);  
            }else{
                
                if(is_array ( $request->respuesta )){
                    
                    $cadena = implode($request->respuesta);
                    $resultado = str_replace(" ", ",", $cadena);
                    $request->respuesta = $resultado;
                } 
                $cuestionario = new Cuestionario;
                $cuestionario->cliente_id = $request->cliente_id;
                $cuestionario->pregunta_id = $request->id;
                $cuestionario->formulario = $formulario;
                $cuestionario->respuesta = $request->respuesta;
                $cuestionario->save(); 
                $clientes = Cliente::withTrashed()->where('recorrido','0');
                $clientes = $clientes->paginate(20);
                return view('backend.cuestionarios.index')->with('cuestionariosData', $clientes)->with('valores',$valores);
            }
        }else{
            if(is_array ( $request->respuesta )){
                    
                $cadena = implode($request->respuesta);
                $resultado = str_replace(" ", ",", $cadena);
                $request->respuesta = $resultado;
            }
            $cuestionario = new Cuestionario;
            $cuestionario->cliente_id = $request->cliente_id;
            $cuestionario->pregunta_id = $request->pregunta_id;
            $cuestionario->formulario = $formulario;
            $cuestionario->respuesta = $request->respuesta;
            $cuestionario->save();
            $preguntas = $preguntas[1];
            $idpre = 2;
            $valores = \App\Valor::where('pregunta_id', $idpre)->get();
            return view('backend.cuestionarios.step')->with('preguntasData', $preguntas)
            ->with('cliente',$cliente)->with('valores', $valores);
        }
    }

    


}
