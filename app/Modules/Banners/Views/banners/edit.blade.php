@extends('admin')

@section('title', 'Banners')

@push('styles')
    <link href="{{ url('/') }}/plugin/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
@endpush

@section('actions')
    <div class="clearfix">
        <b class="btn pull-left" style="cursor: default;">
            gestores
        </b>
        <div class="pull-right">
            <a href="{{ route('admin.banners.details', ['id'=>$banner->id]) }}" class="btn btn-link">
                voltar
            </a>            
        </div>
    </div>
@endsection

@section('content')    

    <small class="text-danger">* campos obrigatórios</small>

    <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.banners.update') }}" enctype="multipart/form-data" id="validate">
        {!! csrf_field() !!}
        
        <input type="hidden" name="id" value="{{ $banner->id }}">

        <div class="form-group">
            <label class="col-md-3 control-label"><small class="text-danger">*</small> Título</label>
            <div class="col-md-7">
                <input type="text" class="form-control" name="title" value="{{ $banner->title }}" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">Subtítulo</label>
            <div class="col-md-7">
                <input type="text" class="form-control" name="subtitle" value="{{ $banner->subtitle }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label"><small class="text-danger">*</small> Descrição</label>
            <div class="col-md-7">
                <textarea class="form-control" name="description" rows="6" required>{{ $banner->description }}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">Link</label>
            <div class="col-md-7">
                <input type="url" class="form-control" name="link" placeholder="http://..." value="@if (count($banner->link)){{$banner->link}}@else{{ old('link') }}@endif">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">Imagem</label>
            <div class="col-md-7">
                <div class="input-group">
                    <input type="file" name="file">
                </div>
                <small class="text-danger">
                    <i class="fa fa-exclamation-circle fa-fw"></i>
                    tamanho recomendado: 1200 X 400px
                </small>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-7 col-md-offset-3">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-thumbs-o-up fa-fw"></i> salvar alterações
                </button>
            </div>
        </div>

    </form>


@stop

@push('scripts')
    <script src="{{ url('/') }}/plugin/bootstrap-filestyle/src/bootstrap-filestyle.min.js"></script>    
<script src="{{ url('/') }}/plugin/jquery-validation/dist/jquery.validate.min.js"></script>    
<script src="{{ url('/') }}/plugin/jquery-validation/src/localization/messages_pt_BR.js"></script> 
    <script>
        $(function(){
            app.filestyle();
            app.validate('form#validate');
        })
    </script>
@endpush