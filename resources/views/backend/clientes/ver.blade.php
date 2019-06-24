@extends(config('main-app-layout', 'redprintUnity::page'))

@section('title') Cliente - Index @stop

@section('page_title') Cliente @stop
@section('page_subtitle') Index @stop
@section('page_icon') <i class="icon-folder"></i> @stop

@section('content')
    <div class="card">

        <div class="card-header">
            <a href="{{ route('cliente.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp; BACK </a>
            
        </div>
        <h1>Datos Monolit</h1>
            <table class="table table-striped table-hover table-bordered">
                <tbody>
                    <thead>
                        <tr>
<td>Fecha</td>
<td>Cita</td>
<td>Lead</td>

</tr>
</thead>
<tr>
<td> {{ $cliente->fecha }}</td>
<td> {{ $cliente->cita }}</td>
<td> {{ $cliente->lead }}</td>
</tr>
</tbody>
</table>
</div>
<h1>Cliente</h1>

        <div class="card-body">
            <table class="table table-striped table-hover table-bordered">
                <tbody>
                    <thead>
                        <tr>
<td>Id</td>
<td>Fecha</td>
<td>Nombre Sr</td>
<td>Estado civil</td>
<td>Ingreso</td>
<td>Tel casa</td>
<td>Correo</td>
<td>Lugar Contactaron</td>
<td>Liner</td>
</tr>
</thead>
<tr>
<td> {{ $cliente->id }}</td>
<td> {{ $cliente->fecha }}</td>
<td> {{ $cliente->nombreSr }}</td>
<td> {{ $cliente->estadoCivil }}</td>
<td> {{ $cliente->ingreso }}</td>
<td> {{ $cliente->telCasa }}</td>
<td> {{ $cliente->correo }}</td>
<td> {{ $cliente->lugaresContactaron }}</td>
<td> {{ $cliente->liner }}</td>


                        
                        
                    </tr>

                    
                </tbody>
            </table>
        </div>
        <div class="card-body">
        <h1>Conyugue</h1>
            <table class="table table-striped table-hover table-bordered">
                <tbody>
                    <thead>
                        <tr>

<td>Nombre Conyugue</td>
<td>Cedula Conyugue</td>
<td>Edad Conyugue</td>
<td>Ocupación Conyugue</td>
</tr>
</thead>

<tr>
<td> {{ $cliente->nombreSra }}</td>
<td> {{ $cliente->cedulaSra }}</td>
<td> {{ $cliente->edadSra }}</td>
<td> {{ $cliente->ocupacionSra }}</td>
</tr>

                    
                </tbody>
            </table>
        </div>
        <div class="card-body">
        <h1>Datos</h1>
            <table class="table table-striped table-hover table-bordered">
                <tbody>
                    <thead>
                        <tr>

<td>Estado Civil</td>
<td>Ingreso</td>
<td>Dirección</td>
<td>Correo</td>
<td>Lugar de Contacto</td>
<td>Propiedad</td>
<td>Opc</td>
<td>Liner</td>
<td>Host</td>
</tr>
</thead>

<tr>
<td> {{ $cliente->estadoCivil }}</td>
<td> {{ $cliente->ingreso }}</td>
<td> {{ $cliente->direccion  }}</td>
<td> {{ $cliente->correo }}</td>
<td> {{ $cliente->lugaresContactaron }}</td>
<td> {{ $cliente->propiedad  }}</td>
<td> {{ $cliente->opc  }}</td>
<td> {{ $cliente->liner   }}</td>
<td> {{ $cliente->hostess    }}</td>
</tr>

                    
                </tbody>
            </table>
        </div>
                
   
        <div class="card-body">
        <h1>Acompañantes</h1>
            <table class="table table-striped table-hover table-bordered">
                <tbody>
                    <thead>
                        <tr>

<td>Nombre</td>
<td>Cedula</td>
<td>Edad</td>
<td>Parentezco</td>
<td>Ocupación</td>
</tr>
</thead>
@foreach($acompanantes as $acompanante)
<tr>
<td> {{ $acompanante->nombre }}</td>
<td> {{ $acompanante->cedula }}</td>
<td> {{ $acompanante->edad }}</td>
<td> {{ $acompanante->qsco }}</td>
<td> {{ $acompanante->ocupacion }}</td>
</tr>
@endforeach
                    
                </tbody>
            </table>
        </div>
        <div class="card-body">
        <h1>Tarjetas de Credito</h1>
            <table class="table table-striped table-hover table-bordered">
                <tbody>
                    <thead>
                        <tr>

<td>Nombre</td>
<td>Cedula</td>
<td>Edad</td>
<td>Parentezco</td>
<td>Ocupación</td>
</tr>
</thead>
@foreach($tarjetas as $tarjeta)
<tr>
<td> {{ $tarjeta->descripcion }}</td>
<td> {{ $tarjeta->tipo }}</td>
<td> {{ $tarjeta->cantidad }}</td>
<td> {{ $tarjeta->pertenece }}</td>

</tr>
@endforeach
                    
                </tbody>
            </table>
        </div> 
        <a href="{{ route('cliente.mostrar', $cliente->id) }}" class="btn btn-primary btn-xs">Edit</a>       
    </div>

    @section('modals')
    @parent
    <!-- cliente search modal -->
    <div class="modal fade" id="searchModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" method="get" action="{{ route('cliente.index') }}" >
                {!! csrf_field() !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ trans('redprint::core.search') }} clientes</h4>
                </div>

                <div class="modal-body">                  
                                                            
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('redprint::core.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ trans('redprint::core.search') }}</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- search modal ends -->
    @stop

@stop