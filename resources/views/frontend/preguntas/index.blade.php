@extends(config('frontend-app-layout', 'layouts.frontend'))

@section('title') Pregunta - Index @stop

@section('page_title') Pregunta @stop
@section('page_subtitle') Index @stop
@section('page_icon') <i class="icon-folder"></i> @stop

@section('content')
    <div class="col-md-6">

        @foreach($preguntasData as $preguntaItem)
            <p class="description">
                <br> {{ $preguntaItem->pregunta }}
<br> {{ $preguntaItem->formulario }}
<br> {{ $preguntaItem->tipo }}

            </p>
        @endforeach

    </div>

    {!! $preguntasData->links() !!}
@stop