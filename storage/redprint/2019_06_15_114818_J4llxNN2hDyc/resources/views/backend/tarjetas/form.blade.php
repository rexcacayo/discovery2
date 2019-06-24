@extends(config('main-app-layout', 'redprintUnity::page'))

@section('title') Tarjeta - Form @stop

@section('page_title') Tarjeta @stop
@section('page_subtitle') @if ($tarjeta->exists) {{ trans('redprint::core.editing') }} Tarjeta: {{ $tarjeta->id }} @else Add New Tarjeta @endif @stop

@section('title')
  @parent
  Tarjeta
@stop

@section('css')
  @parent
  <link rel="stylesheet" href="{{ asset('vendor/redprintUnity/vendor/summernote/summernote-bs4.css') }}" />
@stop

@section('js')
  @parent
  <script src="{{ asset('vendor/redprintUnity/vendor/summernote/summernote-bs4.min.js') }}"></script>
@stop

@section('content')

  <form method="post" action="{{ route('tarjeta.save') }}" enctype="multipart/form-data" >
  {!! csrf_field() !!}
  <div class="card">

    <div class="card-body row">
        <input type="hidden" name="id" value="{{ $tarjeta->id }}" >
                <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('descripcion') ? 'has-error' : '' }}">
            <label>Descripcion</label>
            <input type="text" name="descripcion" class="form-control" value="{{ $tarjeta->descripcion ?: old('descripcion') }}">
            @if ($errors->has('descripcion'))
                <span class="help-block">
                    <strong>{{ $errors->first('descripcion') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('tipo') ? 'has-error' : '' }}">
            <label>Tipo</label>
            <input type="text" name="tipo" class="form-control" value="{{ $tarjeta->tipo ?: old('tipo') }}">
            @if ($errors->has('tipo'))
                <span class="help-block">
                    <strong>{{ $errors->first('tipo') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('cantidad') ? 'has-error' : '' }}">
            <label>Cantidad</label>
            <input type="text" name="cantidad" class="form-control" value="{{ $tarjeta->cantidad ?: old('cantidad') }}">
            @if ($errors->has('cantidad'))
                <span class="help-block">
                    <strong>{{ $errors->first('cantidad') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('pertenece') ? 'has-error' : '' }}">
            <label>Pertenece</label>
            <input type="text" name="pertenece" class="form-control" value="{{ $tarjeta->pertenece ?: old('pertenece') }}">
            @if ($errors->has('pertenece'))
                <span class="help-block">
                    <strong>{{ $errors->first('pertenece') }}</strong>
                </span>
            @endif
        </div>

    </div>

    <div class="card-footer">
      <div class="row">
        <div class="col-sm-8">
          <button type="submit" class="btn-primary btn" >{{ trans('redprint::core.save') }}</button>
        </div>
      </div>
    </div>

  </div>
  </form>

@stop