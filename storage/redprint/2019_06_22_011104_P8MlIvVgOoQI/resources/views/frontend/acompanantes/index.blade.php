@extends(config('frontend-app-layout', 'layouts.frontend'))

@section('title') Acompanante - Index @stop

@section('page_title') Acompanante @stop
@section('page_subtitle') Index @stop
@section('page_icon') <i class="icon-folder"></i> @stop

@section('content')
    <div class="col-md-6">

        @foreach($acompanantesData as $acompananteItem)
            <p class="description">
                <br> {{ $acompananteItem->nombre }}
<br> {{ $acompananteItem->cedula }}
<br> {{ $acompananteItem->edad }}
<br> {{ $acompananteItem->qsco }}
<br> {{ $acompananteItem->ocupacion }}

            </p>
        @endforeach

    </div>

    {!! $acompanantesData->links() !!}
@stop