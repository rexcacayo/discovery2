@extends(config('main-app-layout', 'redprintUnity::page'))

@section('title') Acompanante - Form @stop

@section('page_title') Acompanante @stop
@section('page_subtitle') @if ($acompanante->exists) {{ trans('redprint::core.editing') }} Acompanante: {{ $acompanante->id }} @else Add New Acompanante @endif @stop

@section('title')
  @parent
  Acompanante
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

  <form method="post" action="{{ route('acompanante.save') }}" enctype="multipart/form-data" >
  {!! csrf_field() !!}
  <div class="card">

    <div class="card-body row">
		        <input type="hidden" name="id" value="{{ $acompanante->id }}" >

<div class="form-group col-md-6 col-xs-6 col-lg-6  has-feedback {{ $errors->has('cliente_id') ? 'has-error' : '' }}">
	<label class="control-label"> Cliente <span class="required">*</span></label>
	
    <select name='cliente_id' class ='form-control selectpicker' placeholder='Please select a cliente' data-live-search='true' id ='cliente_id' >
        @foreach($clientes as $entityId => $entityValue)
            <option value="{{ $entityId }}" {{ $acompanante->cliente_id === $entityId ? 'selected' : '' }} >{{ $entityValue }}</option>
        @endforeach
    </select>

  @if ($errors->has('cliente_id'))
    <span class="help-block">
      <strong>{{ $errors->first('cliente_id') }}</strong>
    </span>
  @endif
</div>                <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('nombre') ? 'has-error' : '' }}">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $acompanante->nombre ?: old('nombre') }}">
            @if ($errors->has('nombre'))
                <span class="help-block">
                    <strong>{{ $errors->first('nombre') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('cedula') ? 'has-error' : '' }}">
            <label>Cedula</label>
            <input type="text" name="cedula" class="form-control" value="{{ $acompanante->cedula ?: old('cedula') }}">
            @if ($errors->has('cedula'))
                <span class="help-block">
                    <strong>{{ $errors->first('cedula') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('edad') ? 'has-error' : '' }}">
            <label>Edad</label>
            <input type="text" name="edad" class="form-control" value="{{ $acompanante->edad ?: old('edad') }}">
            @if ($errors->has('edad'))
                <span class="help-block">
                    <strong>{{ $errors->first('edad') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('qsco') ? 'has-error' : '' }}">
            <label>Qsco</label>
            <input type="text" name="qsco" class="form-control" value="{{ $acompanante->qsco ?: old('qsco') }}">
            @if ($errors->has('qsco'))
                <span class="help-block">
                    <strong>{{ $errors->first('qsco') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('ocupacion') ? 'has-error' : '' }}">
            <label>Ocupacion</label>
            <input type="text" name="ocupacion" class="form-control" value="{{ $acompanante->ocupacion ?: old('ocupacion') }}">
            @if ($errors->has('ocupacion'))
                <span class="help-block">
                    <strong>{{ $errors->first('ocupacion') }}</strong>
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