@extends(config('frontend-app-layout', 'layouts.frontend'))

@section('title') Valor - Index @stop

@section('page_title') Valor @stop
@section('page_subtitle') Index @stop
@section('page_icon') <i class="icon-folder"></i> @stop

@section('content')
    <div class="col-md-6">

        @foreach($valorsData as $valorItem)
            <p class="description">
                <br> {{ $valorItem->valor }}

            </p>
        @endforeach

    </div>

    {!! $valorsData->links() !!}
@stop