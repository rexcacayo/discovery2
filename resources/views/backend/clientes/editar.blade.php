@extends(config('main-app-layout', 'redprintUnity::page'))

@section('title') Cliente - Edit @stop

@section('page_title') Cliente @stop
@section('page_subtitle') @if ($cliente->exists) {{ trans('redprint::core.editing') }} Cliente: {{ $cliente->id }} @else Add New Tarjeta @endif @stop

@section('title')
  @parent
  Cliente
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

  <form method="post" action="{{ route('cliente.actualizar') }}" enctype="multipart/form-data" >
  {!! csrf_field() !!}
  <div class="card">
  <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('NombreSra') ? 'has-error' : '' }}">
            <label><h2>Datos Cliente</h2></label>
        </div>  
    <div class="card-body row">
      <input type="hidden" name="id" value="{{ $cliente->id }}" >
         <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-6 {{ $errors->has('nombreSr') ? 'has-error' : '' }}">
            <label>Nombre</label>
            <input type="text" name="nombreSr" class="form-control" value="{{ $cliente->nombreSr ?: old('nombreSr') }}">
            @if ($errors->has('nombreSr'))
                <span class="help-block">
                    <strong>{{ $errors->first('nombreSr') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-6 {{ $errors->has('cedulaSr') ? 'has-error' : '' }}">
            <label>Cédula</label>
            <input type="text" name="cedulaSr" class="form-control" value="{{ $cliente->cedulaSr ?: old('cedulaSr') }}">
            @if ($errors->has('cedulaSr'))
                <span class="help-block">
                    <strong>{{ $errors->first('cedulaSr') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-6 {{ $errors->has('edadSr') ? 'has-error' : '' }}">
            <label>Edad</label>
            <input type="text" name="edadSr" class="form-control" value="{{ $cliente->edadSr ?: old('edadSr') }}">
            @if ($errors->has('edadSr'))
                <span class="help-block">
                    <strong>{{ $errors->first('edadSr') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-6 {{ $errors->has('ocupacionSr') ? 'has-error' : '' }}">
            <label>Ocupación</label>
            <input type="text" name="ocupacionSr" class="form-control" value="{{ $cliente->ocupacionSr ?: old('ocupacionSr') }}">
            @if ($errors->has('ocupacionSr'))
                <span class="help-block">
                    <strong>{{ $errors->first('ocupacionSr') }}</strong>
                </span>
            @endif
        </div>
       
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('nombreSra') ? 'has-error' : '' }}">
            <label><h2>Datos Conyugue</h2></label>
        </div>    
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-6 {{ $errors->has('nombreSra') ? 'has-error' : '' }}">
            <label>Nombre</label>
            <input type="text" name="nombreSra" class="form-control" value="{{ $cliente->nombreSra  ?: old('nombreSra') }}">
            @if ($errors->has('nombreSra'))
                <span class="help-block">
                    <strong>{{ $errors->first('nombreSra') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-6 {{ $errors->has('cedulaSra') ? 'has-error' : '' }}">
            <label>Cédula</label>
            <input type="text" name="cedulaSra" class="form-control" value="{{ $cliente->cedulaSra ?: old('cedulaSra') }}">
            @if ($errors->has('cedulaSra'))
                <span class="help-block">
                    <strong>{{ $errors->first('cedulaSra') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-6 {{ $errors->has('edadSra') ? 'has-error' : '' }}">
            <label>Edad</label>
            <input type="text" name="edadSra" class="form-control" value="{{ $cliente->edadSra ?: old('edadSra') }}">
            @if ($errors->has('edadSra'))
                <span class="help-block">
                    <strong>{{ $errors->first('edadSra') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-6 {{ $errors->has('ocupacionSra') ? 'has-error' : '' }}">
            <label>Ocupación</label>
            <input type="text" name="ocupacionSra" class="form-control" value="{{ $cliente->ocupacionSra ?: old('ocupacionSra') }}">
            @if ($errors->has('ocupacionSra'))
                <span class="help-block">
                    <strong>{{ $errors->first('ocupacionSra') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('estadoCivil') ? 'has-error' : '' }}">
            <label><h2>Datos Personales</h2></label>
        </div>    
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-6 {{ $errors->has('estadoCivil') ? 'has-error' : '' }}">
            <label>Estado Civil</label>
            <input type="text" name="estadoCivil" class="form-control" value="{{ $cliente->estadoCivil  ?: old('estadoCivil') }}">
            @if ($errors->has('estadoCivil'))
                <span class="help-block">
                    <strong>{{ $errors->first('estadoCivil') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-6 {{ $errors->has('ingreso') ? 'has-error' : '' }}">
            <label>Cédula</label>
            <input type="text" name="ingreso" class="form-control" value="{{ $cliente->ingreso ?: old('ingreso') }}">
            @if ($errors->has('ingreso'))
                <span class="help-block">
                    <strong>{{ $errors->first('ingreso') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-6 {{ $errors->has('telCasa') ? 'has-error' : '' }}">
            <label>Teléfono Casa</label>
            <input type="text" name="telCasa" class="form-control" value="{{ $cliente->telCasa ?: old('telCasa') }}">
            @if ($errors->has('telCasa'))
                <span class="help-block">
                    <strong>{{ $errors->first('telCasa') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-6 {{ $errors->has('direccion') ? 'has-error' : '' }}">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control" value="{{ $cliente->direccion ?: old('direccion') }}">
            @if ($errors->has('direccion'))
                <span class="help-block">
                    <strong>{{ $errors->first('direccion') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-6 {{ $errors->has('correo') ? 'has-error' : '' }}">
            <label>Correo</label>
            <input type="text" name="correo" class="form-control" value="{{ $cliente->correo ?: old('correo') }}">
            @if ($errors->has('correo'))
                <span class="help-block">
                    <strong>{{ $errors->first('correo') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-6 {{ $errors->has('lugaresContactaron') ? 'has-error' : '' }}">
            <label>Lugar de Contactaron</label>
            <input type="text" name="lugaresContactaron" class="form-control" value="{{ $cliente->lugaresContactaron ?: old('lugaresContactaron') }}">
            @if ($errors->has('lugaresContactaron'))
                <span class="help-block">
                    <strong>{{ $errors->first('lugaresContactaron') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-6 {{ $errors->has('propiedad') ? 'has-error' : '' }}">
            <label>Tipo de vivienda</label>
            <input type="text" name="propiedad" class="form-control" value="{{ $cliente->propiedad ?: old('propiedad') }}">
            @if ($errors->has('propiedad'))
                <span class="help-block">
                    <strong>{{ $errors->first('propiedad') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-6 {{ $errors->has('opc') ? 'has-error' : '' }}">
            <label>Opc</label>
            <input type="text" name="opc" class="form-control" value="{{ $cliente->opc ?: old('opc') }}">
            @if ($errors->has('opc'))
                <span class="help-block">
                    <strong>{{ $errors->first('opc') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-6 {{ $errors->has('liner') ? 'has-error' : '' }}">
            <label>Liner</label>
            <input type="text" name="liner" class="form-control" value="{{ $cliente->liner ?: old('liner') }}">
            @if ($errors->has('liner'))
                <span class="help-block">
                    <strong>{{ $errors->first('liner') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-6 {{ $errors->has('hostess') ? 'has-error' : '' }}">
            <label>Hostess</label>
            <input type="text" name="hostess" class="form-control" value="{{ $cliente->hostess ?: old('hostess') }}">
            @if ($errors->has('hostess'))
                <span class="help-block">
                    <strong>{{ $errors->first('hostess') }}</strong>
                </span>
            @endif
        </div>

  </div>
  <div class="card-footer">
      <div class="row">
        <div class="col-sm-8">
          <button type="submit" class="btn-primary btn" >Actualizar</button>
        </div>
      </div>
    </div>
  </form>

@stop