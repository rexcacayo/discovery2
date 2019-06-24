<?php

namespace App\Http\Controllers\Backend;

use App\Cliente;
use Illuminate\Http\Request;
use Shahnewaz\Redprint\Traits\CanUpload;
use App\Http\Requests\Backend\ClienteRequest;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToModel;

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
       
		$tarjetas = \App\Tarjeta::pluck('descripcion', 'id')->toArray();
		return view('backend.clientes.form')->with('cliente', $cliente)->with('tarjetas', $tarjetas);
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
            $fileCSV = 'uploads/clientes/'.$cliente->cvs;
            $data = Excel::toArray(new Cliente, $fileCSV);
                $porciones = str_replace("Fecha: ", '', $data[0][0]);
                $porciones = str_replace("Cita: ", '', $porciones);
                $porciones = str_replace("Lead: ", '', $porciones);
                list($fecha , $cita, $lead) = explode(" ", implode($porciones));
                $porciones = str_replace("Nombre :", '', $data[0][1]);
                $porciones = str_replace("Cédula: ", '', $porciones);
                $porciones = str_replace("Sr. ", '', $porciones);
                $porciones = str_replace("Edad: ", '', $porciones);
                $porciones = str_replace("Ocupación: ", '', $porciones);
                list($nombreSr , $apelldioSr , $cedulaSr, $edadSr, $ocupacionSr) = explode(" ", implode($porciones));
                $porciones = str_replace("Nombre :Sra. ", '', $data[0][2]);
                $porciones = str_replace("Cédula: ", '', $porciones);
                $porciones = str_replace("Edad: ", '', $porciones);
                $porciones = str_replace("Ocupación: ", '', $porciones);
                list($nombreSra , $apelldioSra , $cedulaSra, $edadSra, $ocupacionSra) = explode(" ", implode($porciones));
                $porciones = str_replace("Estado Civil :", '', $data[0][3]);
                list($estadocivil) = explode(" ", implode($porciones));
                $porciones = str_replace("Ingreso :", '', $data[0][4]);
                $porciones = str_replace(' ', '', $porciones);
                list($ingreso) = explode(" ", implode($porciones));
                $porciones = str_replace("Tel.Casa : Tel.Cel:", '', $data[0][5]);
                $porciones = str_replace(' ', '', $porciones);
                list($telefono) = explode(" ", implode($porciones));
                $porciones = str_replace("Dirección :", '', $data[0][6]);
                $direccion = $porciones[0];
                $porciones = str_replace("E-Mail :", '', $data[0][7]);
                $email = $porciones[0];
                $porciones = str_replace("Lugar donde los contactaron:", '', $data[0][8]);
                $contactaron = $porciones[0];
                $porciones = str_replace("La casa que habitan actualmente es:", '', $data[0][9]);
                $propiedad = $porciones[0];
                /**LOOP PARA LEER CAMPOS REPETIDOS */
            foreach ($data[0] as $key => $value) {
                $cadena_de_texto = $data[0][$key][0];
                $cadena_buscada = 'Hostess :';
                $posicion_coincidencia = strrpos($cadena_de_texto, $cadena_buscada);

                if ($posicion_coincidencia === 0) {
                    $porciones = str_replace("Hostess :", '', $data[0][$key]);
                    $hostess = $porciones[0];
                }

                $cadena_buscada = 'Opc :';
                $posicion_coincidencia = strrpos($cadena_de_texto, $cadena_buscada);
                if ($posicion_coincidencia === 0) {
                    $porciones = str_replace("Opc :", '', $data[0][$key]);
                    $opc = $porciones[0];
                }

                $cadena_buscada = 'Liner :';
                $posicion_coincidencia = strrpos($cadena_de_texto, $cadena_buscada);
                if ($posicion_coincidencia === 0) {
                    $porciones = str_replace("Liner :", '|', $data[0][$key]);
                    $porciones = str_replace("Calificación:", '|', $porciones);
                    list($hold, $liner , $clasificacion) = explode("|", implode($porciones));
                }
            }
                
                $start_key = null;
                $end_key = null;
                $start_keyI = null;
                $end_keyI = null;

            foreach ($data[0] as $key => $value) {
                if ($value[0] === 'TARJETAS') {
                    $start_key = $key + 2;
                }

                $cadena_de_texto = $value[0];
                $cadena_buscada = 'Opc :';
                $posicion_coincidencia = strrpos($cadena_de_texto, $cadena_buscada);
                if ($posicion_coincidencia === 0) {
                    $end_key = $key;
                }
            }

            foreach ($data[0] as $key => $value) {
                if ($value[0] === 'Acompañantes:') {
                    $start_keyI = $key + 2;
                }

                $cadena_de_texto = $value[0];
                $cadena_buscada = 'TARJETAS';
                $posicion_coincidencia = strrpos($cadena_de_texto, $cadena_buscada);
                if ($posicion_coincidencia === 0) {
                    $end_keyI = $key;
                }
            }

            if ($start_keyI !== $end_keyI) {
                for ($i = $start_keyI; $i < $end_keyI; $i++) {
                    $acompañantes[] =  $data[0][$i][0];
                }
            }

            if ($start_key !== $end_key) {
                for ($i = $start_key; $i < $end_key; $i++) {
                    $tarjetas[] =  $data[0][$i][0];
                }
            }
        } else {
            $cliente->cvs = $cliente->cvs;
        }
        /**ASIGNANDO VALOR A LOS CAMPOS */
        $cliente->fecha = $fecha;
        $cliente->cita = $cita;
        $cliente->lead = $lead;
        $cliente->nombreSr = $nombreSr.' '. $apelldioSr;
        $cliente->cedulaSr = $cedulaSr;
        $cliente->edadSr = $edadSr;
        $cliente->ocupacionSr = $ocupacionSr;
        $cliente->nombreSra = $nombreSra.' '. $apelldioSra;
        $cliente->cedulaSra = $cedulaSra;
        $cliente->edadSra = $edadSra;
        $cliente->ocupacionSra = $ocupacionSra;
        $cliente->estadoCivil = $estadocivil;
        $cliente->ingreso = $ingreso;
        $cliente->telCasa = $telefono;
        $cliente->direccion = $direccion;
        $cliente->correo = $email;
        $cliente->lugaresContactaron = trim($contactaron);
        $cliente->propiedad = trim($propiedad);
        $cliente->opc = $opc;
        $cliente->liner = $liner;
        $cliente->hostess = trim($hostess);
$cliente->tarjeta_id = $request->get('tarjeta_id');
        //$cliente->save();
        
        //Descripción Tipo Cantidad Pertenece a
        dd($tarjetas);
        
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
