@extends(config('frontend-app-layout', 'layouts.frontend'))

@section('title') Cliente - Index @stop

@section('page_title') Cliente @stop
@section('page_subtitle') Index @stop
@section('page_icon') <i class="icon-folder"></i> @stop

@section('content')
    <div class="col-md-6">

        @foreach($clientesData as $clienteItem)
            <p class="description">
                <br> {{ $clienteItem->id }}
<br> {{ $clienteItem->fecha }}
<br> {{ $clienteItem->nombreSr }}
<br> {{ $clienteItem->estadoCivil }}
<br> {{ $clienteItem->ingreso }}
<br> {{ $clienteItem->telCasa }}
<br> {{ $clienteItem->correo }}
<br> {{ $clienteItem->lugaresContactaron }}
<br> {{ $clienteItem->liner }}
<br> {{ $clienteItem->cvs }}

            </p>
        @endforeach

    </div>

    {!! $clientesData->links() !!}
@stop