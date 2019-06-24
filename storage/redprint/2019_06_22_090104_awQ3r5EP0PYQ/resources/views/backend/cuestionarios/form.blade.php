@extends(config('main-app-layout', 'redprintUnity::page'))

@section('title') Cuestionario - Form @stop

@section('page_title') Cuestionario @stop
@section('page_subtitle') @if ($cuestionario->exists) {{ trans('redprint::core.editing') }} Cuestionario: {{ $cuestionario->id }} @else Add New Cuestionario @endif @stop

@section('title')
  @parent
  Cuestionario
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

  <form method="post" action="{{ route('cuestionario.save') }}" enctype="multipart/form-data" >
  {!! csrf_field() !!}
  <div class="card">

    <div class="card-body row">
        <input type="hidden" name="id" value="{{ $cuestionario->id }}" >
                <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('respuesta') ? 'has-error' : '' }}">
            <label>Respuesta</label>
            <input type="text" name="respuesta" class="form-control" value="{{ $cuestionario->respuesta ?: old('respuesta') }}">
            @if ($errors->has('respuesta'))
                <span class="help-block">
                    <strong>{{ $errors->first('respuesta') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('formulario') ? 'has-error' : '' }}">
            <label>Formulario</label>
            <input type="text" name="formulario" class="form-control" value="{{ $cuestionario->formulario ?: old('formulario') }}">
            @if ($errors->has('formulario'))
                <span class="help-block">
                    <strong>{{ $errors->first('formulario') }}</strong>
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