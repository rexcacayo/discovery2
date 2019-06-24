@extends(config('frontend-app-layout', 'layouts.frontend'))

@section('title') Parametro - Index @stop

@section('page_title') Parametro @stop
@section('page_subtitle') Index @stop
@section('page_icon') <i class="icon-folder"></i> @stop

@section('content')
    <div class="col-md-6">

        @foreach($parametrosData as $parametroItem)
            <p class="description">
                <br> {{ $parametroItem->formulario }}
<br> {{ $parametroItem->tipopregunta }}

            </p>
        @endforeach

    </div>

    {!! $parametrosData->links() !!}
@stop