@extends(config('main-app-layout', 'redprintUnity::page'))

@section('title') Acompanante - Index @stop

@section('page_title') Acompanante @stop
@section('page_subtitle') Index @stop
@section('page_icon') <i class="icon-folder"></i> @stop

@section('content')
    <div class="card">

        <div class="card-header">
            <a href="{{ route('acompanante.new') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;{{ trans('redprint::core.new') }}</a>
            <div class="btn-group float-right">
                @if(count(Request::input()))
                    <a class="btn btn-default" href="{{ route('acompanante.index') }}">{{ trans('redprint::core.clear') }}</a>
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
                            <td>Nombre</td>
<td>Cedula</td>
<td>Edad</td>
<td>Qsco</td>
<td>Ocupacion</td>

                            <th>{{ trans('redprint::core.actions') }}</th>
                        </tr>
                    </thead>
                    @foreach($acompanantesData as $acompananteItem)
                    <tr>
                        <td> {{ $acompananteItem->nombre }}</td>
<td> {{ $acompananteItem->cedula }}</td>
<td> {{ $acompananteItem->edad }}</td>
<td> {{ $acompananteItem->qsco }}</td>
<td> {{ $acompananteItem->ocupacion }}</td>

                        <th>
    
                            <a href="{{ route('acompanante.form', $acompananteItem->id) }}" class="btn btn-primary btn-xs">{{ trans('redprint::core.edit') }}</a>
                            <a href="#" class="btn btn-xs btn-warning" data-target="#deleteModal{{ $acompananteItem->id }}" data-toggle="modal" >{{ trans('redprint::core.delete') }}</a>

                            @section('modals')
                            @parent
                            <!-- modal starts -->
                            <div class="modal fade" id="deleteModal{{ $acompananteItem->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form class="form-horizontal" method="post" action="{{ route('acompanante.delete', $acompananteItem->id) }}" >
                                        {!! csrf_field() !!}
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title"> {{ trans('redprint::core.delete') }}: {{ $acompananteItem->id }} </h4>
                                        </div>
                        
                                        <div class="modal-body">
                                            {{ trans('redprint::core.confirm_delete') }} <strong>{{ $acompananteItem->id }} ?</strong>
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
                            @stop
                        </th>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {!! $acompanantesData->links() !!}
        </div>
    </div>

    @section('modals')
    @parent
    <!-- acompanante search modal -->
    <div class="modal fade" id="searchModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="get" class="form-horizontal" action="{{ route('acompanante.index') }}" >
                {!! csrf_field() !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ trans('redprint::core.search') }} acompanantes</h4>
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