@extends(config('main-app-layout', 'redprintUnity::page'))

@section('title') Cliente - Index @stop

@section('page_title') Cliente @stop
@section('page_subtitle') Index @stop
@section('page_icon') <i class="icon-folder"></i> @stop

@section('content')
    <div class="card">

        <div class="card-header">
            <a href="{{ route('cliente.new') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;{{ trans('redprint::core.new') }}</a>
            <div class="btn-group float-right">
                @if(count(Request::input()))
                    <a class="btn btn-default" href="{{ route('cliente.index') }}">{{ trans('redprint::core.clear') }}</a>
                    <a class="btn btn-primary" id="searchButton" data-toggle="modal" data-target="#searchModal" href="#">{{ trans('redprint::core.modify_search') }}</a>
                @else
                    <a class="btn btn-primary" id="searchButton" data-toggle="modal" data-target="#searchModal" href="#"><i class="icon-search"></i>&nbsp;&nbsp;{{ trans('redprint::core.search') }}</a>
                @endif
            </div>
        </div>


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


                            <th>{{ trans('redprint::core.actions') }}</th>
                        </tr>
                    </thead>
                    @foreach($clientesData as $clienteItem)
                    <tr>
                        <td> {{ $clienteItem->id }}</td>
<td> {{ $clienteItem->fecha }}</td>
<td> {{ $clienteItem->nombreSr }}</td>
<td> {{ $clienteItem->estadoCivil }}</td>
<td> {{ $clienteItem->ingreso }}</td>
<td> {{ $clienteItem->telCasa }}</td>
<td> {{ $clienteItem->correo }}</td>
<td> {{ $clienteItem->lugaresContactaron }}</td>
<td> {{ $clienteItem->liner }}</td>


                        <th>
                            @if(!$clienteItem->deleted_at)
                                <a href="{{ route('cliente.ver', $clienteItem->id) }}" class="btn btn-primary btn-xs">View</a>
                                <a href="#" class="btn btn-xs btn-warning" data-target="#deleteModal{{ $clienteItem->id }}" data-toggle="modal" >{{ trans('redprint::core.delete') }}</a>


                                <!-- modal starts -->
                                <div class="modal fade" id="deleteModal{{ $clienteItem->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form class="form-horizontal" method="post" action="{{ route('cliente.delete', $clienteItem->id) }}" >
                                            {!! csrf_field() !!}
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"> {{ trans('redprint::core.delete') }}: {{ $clienteItem->id }} </h4>
                                            </div>
                            
                                            <div class="modal-body">
                                                {{ trans('redprint::core.confirm_delete') }} <strong>{{ $clienteItem->id }} ?</strong>
                                            </div>
                            
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('redprint::core.close') }}</button>
                                                <button type="submit" class="btn btn-danger">{{ trans('redprint::core.delete') }}</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- modal ends -->

                            @else

                                <a href="#" class="btn btn-xs btn-success" data-target="#restoreModal{{ $clienteItem->id }}" data-toggle="modal" >Restore</a>
                                <a href="#" class="btn btn-xs btn-danger" data-target="#forceDeleteModal{{ $clienteItem->id }}" data-toggle="modal" >{{ trans('redprint::core.permanently_delete') }}</a>


                                <!-- modal starts -->
                                <div class="modal fade" id="restoreModal{{ $clienteItem->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form class="form-horizontal" method="post" action="{{ route('cliente.restore', $clienteItem->id) }}" >
                                            {!! csrf_field() !!}

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"> {{ trans('redprint::core.restore') }}: {{ $clienteItem->id }} </h4>
                                            </div>
                            
                                            <div class="modal-body">
                                                {{ trans('redprint::core.confirm_restore') }} <code>{{ $clienteItem->id }} ?</code>
                                            </div>
                            
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('redprint::core.close') }}</button>
                                                <button type="submit" class="btn btn-primary">{{ trans('redprint::core.restore') }}</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- modal ends -->



                                <!-- modal starts -->
                                <div class="modal fade" id="forceDeleteModal{{ $clienteItem->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form class="form-horizontal" method="post" action="{{ route('cliente.force-delete', $clienteItem->id) }}" >
                                            {!! csrf_field() !!}
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"> Permanently: {{ $clienteItem->id }} </h4>
                                            </div>
                            
                                            <div class="modal-body">
                                                {{ trans('redprint::core.confirm_permanent_delete') }} <strong>{{ $clienteItem->id }} </strong> ? {{ trans('redprint::core.permanent_delete_warning') }}
                                            </div>
                            
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('redprint::core.close') }}</button>
                                                <button type="submit" class="btn btn-primary">{{ trans('redprint::core.permanently_delete') }}</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- modal ends -->

                            @endif
                        </th>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {!! $clientesData->links() !!}
        </div>
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