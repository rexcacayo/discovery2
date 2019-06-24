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
                
                
                 
    

@foreach($preguntasData as $preguntasItem)
<div class="form-group col-md-12 col-xs-12 col-lg-12  has-feedback {{ $errors->has('answer') ? 'has-error' : '' }}">
	<label class="control-label"> {{$preguntasItem->pregunta}} <span class="required">*</span></label>
  <br>
  @php
  $input= $preguntasItem->tipo;
  
  if($input === "number"){
    $respuesta = '<input type="number" name="respuesta"  >';
  }
  if($input === "text"){
    $respuesta = '<input type="text" name="respuesta" >';
  }
  if($input === "select"){
    $respuesta = '<select name="respuesta" >';
    foreach($valores as $valor){
      $opciones[] =   '<option value="'.$valor->valor.'">'.$valor->valor.'</option>';
    }
    $respuestacerrar = '</select>';
  }

  if($input === "radio"){
    $respuesta = '';
    foreach($valores as $valor){
      $opciones[] = '<input type="radio" name="respuesta" value="'.$valor->valor.'" > '.$valor->valor.'';
    }
    $respuestacerrar = '';
  }

  if($input === "checkbox"){
    foreach($valores as $valor){
      $opciones[] = '<input type="checkbox" name="respuesta[]" value="'.$valor->valor.'" > '.$valor->valor.'';
    }

    $respuesta = '';
    $respuestacerrar = "";
    } 

    if($input === "range"){
    foreach($valores as $valor){
      if(isset($min)){
        $max = $valor->valor;
      }else{
        $min = $valor->valor;
      }
    }
    $respuesta = $min.'<input type="range" name="respuesta" list="marks" min="'.$min.'" max="'.$max.'" step="1" >'.$max;
    }


  @endphp
 
  <input type="hidden" name="pregunta_id" value="{{ $preguntasItem->id }}" >
	{!! $respuesta !!}

  @php
  if(isset($opciones)){
    foreach($opciones as $opcion){
     echo $opcion; 
    }
    echo $respuestacerrar;
  }
  @endphp  
 
</div>
@endforeach      
    </div>
    
    
      
    <div class="card-footer">
      <div class="row">
        <div class="col-sm-8">
          <button type="submit" class="btn-primary btn" >Siguiente</button>
        
        </div>
      </div>
    </div>

  </div>
  </form>

@stop