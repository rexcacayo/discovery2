@extends(config('main-app-layout', 'redprintUnity::page'))

@section('title') Pregunta - Form @stop

@section('page_title') Pregunta @stop
@section('page_subtitle') @if ($pregunta->exists) {{ trans('redprint::core.editing') }} Pregunta: {{ $pregunta->id }} @else Add New Pregunta @endif @stop

@section('title')
  @parent
  Pregunta
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

  <form method="post" action="{{ route('pregunta.save') }}" enctype="multipart/form-data" >
  {!! csrf_field() !!}
  <div class="card">

    <div class="card-body row">
		        <input type="hidden" name="id" value="{{ $pregunta->id }}" >

<div class="form-group col-md-6 col-xs-6 col-lg-6  has-feedback {{ $errors->has('parametro_id') ? 'has-error' : '' }}">
	<label class="control-label"> Parametro <span class="required">*</span></label>
	
    <select name='parametro_id' class ='form-control selectpicker' placeholder='Please select a parametro' data-live-search='true' id ='parametro_id' >
        @foreach($parametros as $entityId => $entityValue)
            <option value="{{ $entityId }}" {{ $pregunta->parametro_id === $entityId ? 'selected' : '' }} >{{ $entityValue }}</option>
        @endforeach
    </select>

  @if ($errors->has('parametro_id'))
    <span class="help-block">
      <strong>{{ $errors->first('parametro_id') }}</strong>
    </span>
  @endif
</div>                <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('pregunta') ? 'has-error' : '' }}">
            <label>Pregunta</label>
            <input type="text" name="pregunta" class="form-control" value="{{ $pregunta->pregunta ?: old('pregunta') }}">
            @if ($errors->has('pregunta'))
                <span class="help-block">
                    <strong>{{ $errors->first('pregunta') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('formulario') ? 'has-error' : '' }}">
            <label>Formulario</label>
            <input type="text" name="formulario" class="form-control" value="{{ $pregunta->formulario ?: old('formulario') }}">
            @if ($errors->has('formulario'))
                <span class="help-block">
                    <strong>{{ $errors->first('formulario') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('tipo') ? 'has-error' : '' }}">
            <label>Tipo</label>
            <input type="text" name="tipo" class="form-control" value="{{ $pregunta->tipo ?: old('tipo') }}">
            @if ($errors->has('tipo'))
                <span class="help-block">
                    <strong>{{ $errors->first('tipo') }}</strong>
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