@extends(config('frontend-app-layout', 'layouts.frontend'))

@section('title') Tarjeta - Index @stop

@section('page_title') Tarjeta @stop
@section('page_subtitle') Index @stop
@section('page_icon') <i class="icon-folder"></i> @stop

@section('content')
    <div class="col-md-6">

        @foreach($tarjetasData as $tarjetaItem)
            <p class="description">
                <br> {{ $tarjetaItem->descripcion }}
<br> {{ $tarjetaItem->tipo }}
<br> {{ $tarjetaItem->cantidad }}
<br> {{ $tarjetaItem->pertenece }}

            </p>
        @endforeach

    </div>

    {!! $tarjetasData->links() !!}
@stop