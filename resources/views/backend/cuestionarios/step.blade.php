<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/estilos.css') }}" >
@extends(config('main-app-layout', 'redprintUnity::page'))

@section('title') Cuestionario - Form @stop

@section('page_title') Cuestionario @stop

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

  <form method="post" action="{{ route('cuestionario.paso') }}" enctype="multipart/form-data" >
  {!! csrf_field() !!}
  <div class="card">

    <div class="card-body row">
				        <input type="hidden" name="cliente_id" value="{{ $cliente['id'] }}" >
                <input type="hidden" name="id" value="{{ $preguntasData->id }}" > 
    
    


<div class="form-group col-md-12 col-xs-12 col-lg-12  has-feedback {{ $errors->has('pregunta_id') ? 'has-error' : '' }}">
	<label class="control-label"> {{$preguntasData->pregunta}} <span class="required">*</span></label><br>
	@php
  $input= $preguntasData->tipo;
  
  if($input === "number"){
    $respuesta = '<input type="number" name="respuesta" class="form-control">';
  }
  if($input === "text"){
    $respuesta = '<input type="text" name="respuesta" class="form-control">';
  }
  if($input === "select"){
    $respuesta = '<select name="respuesta" class="form-control">';
    foreach($valores as $valor){
      $opciones[] =   '<option value="'.$valor->valor.'">'.$valor->valor.'</option>';
    }
    $respuestacerrar = '</select>';
  }

  if($input === "range"){
    foreach($valores as $valor){
      if(isset($min)){
        $max = $valor->valor;
      }else{
        $min = $valor->valor;
      }
    }
    $respuesta = $min.'<input type="range" name="respuesta" list="marks" min="'.$min.'" max="'.$max.'" step="1">'.$max;
    }
    
    if($input === "radio"){
    foreach($valores as $valor){
      $opciones[] = '<input type="radio" name="respuesta" value="'.$valor->valor.'" class="form-control"> '.$valor->valor.'';
    }
    $respuesta = '';
    $respuestacerrar = "";
    }
   

    if($input === "checkbox"){
    foreach($valores as $valor){
      $opciones[] = '<input type="checkbox" name="respuesta[]" value="'.$valor->valor.'" class="form-check-input" id="inlineCheckbox1"><label class="form-check-label" for="inlineCheckbox1">'.$valor->valor.'</label> ';
    }

    $respuesta = '';
    $respuestacerrar = "";
    }


  @endphp
  {!! $respuesta !!}
  @if(isset($respuestacerrar))
    @foreach($opciones as $opcion)
      {!!$opcion!!}
    @endforeach
    {!!$respuestacerrar !!}
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