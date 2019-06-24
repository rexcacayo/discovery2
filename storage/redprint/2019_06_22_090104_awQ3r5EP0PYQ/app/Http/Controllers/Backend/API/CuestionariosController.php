<?php

namespace App\Http\Controllers\Backend\API;

use App\Cuestionario;
use Illuminate\Http\Request;
use Shahnewaz\Redprint\Traits\CanUpload;
use App\Http\Requests\Backend\CuestionarioRequest;
use App\Http\Resources\CuestionarioCollection;
use App\Http\Resources\Cuestionario as CuestionarioResource;
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
        $cuestionarios = Cuestionario::query();
        
        $cuestionarios = $cuestionarios->paginate(20);
        return (new CuestionarioCollection($cuestionarios));
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

        $responseCode = $request->get('id') ? 200 : 201;
        return response()->json(['saved' => true], $responseCode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $cuestionario = Cuestionario::find($request->get('id'));
        $cuestionario->delete();
        return response()->json(['no_content' => true], 200);
    }

    /**
     * Restore the specified resource to storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request)
    {
        $cuestionario = Cuestionario::withTrashed()->find($request->get('id'));
        $cuestionario->restore();
        return response()->json(['no_content' => true], 200);
    }
}
