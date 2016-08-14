@extends('admin')

@section('title', 'Artigos')

@push('styles')
<link rel="stylesheet" href="{{ url('/') }}/plugin/bootstrap-select/dist/css/bootstrap-select.min.css">
@endpush

@section('actions')
<div class="clearfix">
    <b class="btn pull-left" style="cursor: default;">
        artigos
    </b>
    <div class="pull-right">
        <a href="{{ route('admin.posts.details', ['id'=>$post->id]) }}" class="btn btn-link">
            voltar
        </a>            
    </div>
</div>
@endsection

@section('content')

<small class="text-danger">* campos obrigatórios</small>

<form class="form-horizontal" role="form" method="POST" action="{{ route('admin.posts.update') }}" enctype="multipart/form-data" id="validate">
    {!! csrf_field() !!}

    <input type="hidden" name="id" value="{{$post->id}}"/>

    <div class="form-group">
        <label class="col-md-3 control-label"><small class="text-danger">*</small> Título</label>
        <div class="col-md-5">
            <input type="text" class="form-control" name="title" value="{{ $post->title }}" required>
        </div>
    </div>   
    
    <div class="form-group">
        <label class="col-md-3 control-label"><small class="text-danger">*</small> Subtítulo</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="subtitle" value="{{ $post->subtitle }}" required>
        </div>
    </div> 

    <div class="form-group">
        <label class="col-md-3 control-label"><small class="text-danger">*</small> Conteúdo</label>
        <div class="col-md-7">
            <textarea class="form-control ckeditor" name="content" rows="6" required>{!! $post->content !!}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">Imagem</label>
        <div class="col-md-7">
            <div class="input-group">
                <input type="file" name="image">
            </div>
            <small class="text-danger">
                <i class="fa fa-exclamation-circle fa-fw"></i>
                tamanho recomendado: 1200 X 400px
            </small>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-md-3 control-label"><small class="text-danger">*</small> Tags</label>
        <div class="col-md-7">
            <textarea 
                class="form-control" 
                name="tags" 
                rows="2" 
                required>{{ $tags }}</textarea>
            <small class="text-danger">
                <i class="fa fa-exclamation-circle fa-fw"></i>
                de 3 a 4 palavras relacionadas separadas por vírgula.
            </small>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-7 col-md-offset-3">                
            <button type="submit" class="btn btn-success">
                <i class="fa fa-thumbs-o-up"></i> salvar alterações
            </button>
        </div>
    </div>
</form>


@stop

@push('scripts')
<script src="{{ url('/') }}/plugin/bootstrap-filestyle/src/bootstrap-filestyle.min.js"></script> 
<script src="{{ url('/') }}/plugin/bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript" charset="utf-8" async defer></script>  
<script src="{{ url('/') }}/plugin/ckeditor/ckeditor.js" type="text/javascript" charset="utf-8" async defer></script>    
<script src="{{ url('/') }}/plugin/jquery-validation/dist/jquery.validate.min.js"></script>    
<script src="{{ url('/') }}/plugin/jquery-validation/src/localization/messages_pt_BR.js"></script>  
<script type="text/javascript">
$(function () {
    app.validate('form#validate');
});
</script>   
@endpush
