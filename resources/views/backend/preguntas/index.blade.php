@extends(config('main-app-layout', 'redprintUnity::page'))

@section('title') Pregunta - Index @stop

@section('page_title') Pregunta @stop
@section('page_subtitle') Index @stop
@section('page_icon') <i class="icon-folder"></i> @stop

@section('content')
    <div class="card">

        <div class="card-header">
            <a href="{{ route('pregunta.new') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;{{ trans('redprint::core.new') }}</a>
            <div class="btn-group float-right">
                @if(count(Request::input()))
                    <a class="btn btn-default" href="{{ route('pregunta.index') }}">{{ trans('redprint::core.clear') }}</a>
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
                            <td>Pregunta</td>
<td>Formulario</td>
<td>Tipo</td>

                            <th>{{ trans('redprint::core.actions') }}</th>
                        </tr>
                    </thead>
                    @foreach($preguntasData as $preguntaItem)
                    <tr>
                        <td> {{ $preguntaItem->pregunta }}</td>
<td> {{ $preguntaItem->formulario }}</td>
<td> {{ $preguntaItem->tipo }}</td>

                        <th>
                            @if(!$preguntaItem->deleted_at)
                                <a href="{{ route('pregunta.form', $preguntaItem->id) }}" class="btn btn-primary btn-xs">{{ trans('redprint::core.edit') }}</a>
                                <a href="#" class="btn btn-xs btn-warning" data-target="#deleteModal{{ $preguntaItem->id }}" data-toggle="modal" >{{ trans('redprint::core.delete') }}</a>


                                <!-- modal starts -->
                                <div class="modal fade" id="deleteModal{{ $preguntaItem->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form class="form-horizontal" method="post" action="{{ route('pregunta.delete', $preguntaItem->id) }}" >
                                            {!! csrf_field() !!}
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"> {{ trans('redprint::core.delete') }}: {{ $preguntaItem->id }} </h4>
                                            </div>
                            
                                            <div class="modal-body">
                                                {{ trans('redprint::core.confirm_delete') }} <strong>{{ $preguntaItem->id }} ?</strong>
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

                                <a href="#" class="btn btn-xs btn-success" data-target="#restoreModal{{ $preguntaItem->id }}" data-toggle="modal" >Restore</a>
                                <a href="#" class="btn btn-xs btn-danger" data-target="#forceDeleteModal{{ $preguntaItem->id }}" data-toggle="modal" >{{ trans('redprint::core.permanently_delete') }}</a>


                                <!-- modal starts -->
                                <div class="modal fade" id="restoreModal{{ $preguntaItem->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form class="form-horizontal" method="post" action="{{ route('pregunta.restore', $preguntaItem->id) }}" >
                                            {!! csrf_field() !!}

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"> {{ trans('redprint::core.restore') }}: {{ $preguntaItem->id }} </h4>
                                            </div>
                            
                                            <div class="modal-body">
                                                {{ trans('redprint::core.confirm_restore') }} <code>{{ $preguntaItem->id }} ?</code>
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
                                <div class="modal fade" id="forceDeleteModal{{ $preguntaItem->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form class="form-horizontal" method="post" action="{{ route('pregunta.force-delete', $preguntaItem->id) }}" >
                                            {!! csrf_field() !!}
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"> Permanently: {{ $preguntaItem->id }} </h4>
                                            </div>
                            
                                            <div class="modal-body">
                                                {{ trans('redprint::core.confirm_permanent_delete') }} <strong>{{ $preguntaItem->id }} </strong> ? {{ trans('redprint::core.permanent_delete_warning') }}
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
            {!! $preguntasData->links() !!}
        </div>
    </div>

    @section('modals')
    @parent
    <!-- pregunta search modal -->
    <div class="modal fade" id="searchModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" method="get" action="{{ route('pregunta.index') }}" >
                {!! csrf_field() !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ trans('redprint::core.search') }} preguntas</h4>
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