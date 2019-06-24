@extends(config('main-app-layout', 'redprintUnity::page'))

@section('title') Valor - Form @stop

@section('page_title') Valor @stop
@section('page_subtitle') @if ($valor->exists) {{ trans('redprint::core.editing') }} Valor: {{ $valor->id }} @else Add New Valor @endif @stop

@section('title')
  @parent
  Valor
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

  <form method="post" action="{{ route('valor.save') }}" enctype="multipart/form-data" >
  {!! csrf_field() !!}
  <div class="card">

    <div class="card-body row">
		        <input type="hidden" name="id" value="{{ $valor->id }}" >

<div class="form-group col-md-6 col-xs-6 col-lg-6  has-feedback {{ $errors->has('pregunta_id') ? 'has-error' : '' }}">
	<label class="control-label"> Pregunta <span class="required">*</span></label>
	
    <select name='pregunta_id' class ='form-control selectpicker' placeholder='Please select a pregunta' data-live-search='true' id ='pregunta_id' >
        @foreach($preguntas as $entityId => $entityValue)
            <option value="{{ $entityId }}" {{ $valor->pregunta_id === $entityId ? 'selected' : '' }} >{{ $entityValue }}</option>
        @endforeach
    </select>

  @if ($errors->has('pregunta_id'))
    <span class="help-block">
      <strong>{{ $errors->first('pregunta_id') }}</strong>
    </span>
  @endif
</div>                <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('valor') ? 'has-error' : '' }}">
            <label>Valor</label>
            <input type="text" name="valor" class="form-control" value="{{ $valor->valor ?: old('valor') }}">
            @if ($errors->has('valor'))
                <span class="help-block">
                    <strong>{{ $errors->first('valor') }}</strong>
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