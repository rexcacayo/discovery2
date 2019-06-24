@extends(config('frontend-app-layout', 'layouts.frontend'))

@section('title') Cuestionario - Index @stop

@section('page_title') Cuestionario @stop
@section('page_subtitle') Index @stop
@section('page_icon') <i class="icon-folder"></i> @stop

@section('content')
    <div class="col-md-6">

        @foreach($cuestionariosData as $cuestionarioItem)
            <p class="description">
                <br> {{ $cuestionarioItem->respuesta }}
<br> {{ $cuestionarioItem->formulario }}

            </p>
        @endforeach

    </div>

    {!! $cuestionariosData->links() !!}
@stop