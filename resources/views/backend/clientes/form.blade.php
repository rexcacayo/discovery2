@extends(config('main-app-layout', 'redprintUnity::page'))

@section('title') Cliente - Form @stop

@section('page_title') Cliente @stop
@section('page_subtitle') @if ($cliente->exists) {{ trans('redprint::core.editing') }} Cliente: {{ $cliente->id }} @else Add New Cliente @endif @stop

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

  <form method="post" action="{{ route('cliente.save') }}" enctype="multipart/form-data" >
  {!! csrf_field() !!}
  <div class="card">

    <div class="card-body row">
				        <input type="hidden" name="id" value="{{ $cliente->id }}" >


            <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('cvs') ? 'has-error' : '' }}"">
        <label>{{ \Lang::has('redprint::strings.cvs') ? trans('redprint::strings.cvs') :  'Cvs' }} </label>
        <div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-default btn-file">
                    {{ trans('redprint::core.browse') }} <input type="file" class="fileInp" name="cvs">
                </span>
            </span>
            <input type="text" class="form-control" readonly>
        </div>

        @if($cliente->cvs)
            <div class="file-type-container">{{ substr(strrchr($cliente->cvs,'.'),1) }}</div>
        @else
            <div class="file-type-container">File</div>
        @endif

        @if($errors->has("cvs"))
            <div class="invalid-feedback">
                {{$errors->first("cvs")}}
            </div>
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