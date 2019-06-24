@extends(config('main-app-layout', 'redprintUnity::page'))

@section('title') Parametro - Form @stop

@section('page_title') Parámetro @stop
@section('page_subtitle') @if ($parametro->exists) {{ trans('redprint::core.editing') }} Parametro: {{ $parametro->id }} @else Add New Parametro @endif @stop

@section('title')
  @parent
  Parámetro
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

  <form method="post" action="{{ route('parametro.save') }}" enctype="multipart/form-data" >
  {!! csrf_field() !!}
  <div class="card">

    <div class="card-body row">
		        <input type="hidden" name="id" value="{{ $parametro->id }}" >

<div class="form-group col-md-6 col-xs-6 col-lg-6  has-feedback {{ $errors->has('pregunta_id') ? 'has-error' : '' }}">
	<label class="control-label"> Pregunta <span class="required">*</span></label>
	
    <select name='pregunta_id' class ='form-control selectpicker' placeholder='Please select a pregunta' data-live-search='true' id ='pregunta_id' >
        @foreach($preguntas as $entityId => $entityValue)
            <option value="{{ $entityId }}" {{ $parametro->pregunta_id === $entityId ? 'selected' : '' }} >{{ $entityValue }}</option>
        @endforeach
    </select>

  @if ($errors->has('pregunta_id'))
    <span class="help-block">
      <strong>{{ $errors->first('pregunta_id') }}</strong>
    </span>
  @endif
</div>                <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('formulario') ? 'has-error' : '' }}">
            <label>Formulario</label>
            <input type="text" name="formulario" class="form-control" value="{{ $parametro->formulario ?: old('formulario') }}">
            @if ($errors->has('formulario'))
                <span class="help-block">
                    <strong>{{ $errors->first('formulario') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('tipopregunta') ? 'has-error' : '' }}">
            <label>Tipopregunta</label>
            <input type="text" name="tipopregunta" class="form-control" value="{{ $parametro->tipopregunta ?: old('tipopregunta') }}">
            @if ($errors->has('tipopregunta'))
                <span class="help-block">
                    <strong>{{ $errors->first('tipopregunta') }}</strong>
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