@extends('admin')

@section('title', 'Produtos')

@push('styles')
<link rel="stylesheet" href="{{ url('/') }}/plugin/bootstrap-select/dist/css/bootstrap-select.min.css">
@endpush

@section('actions')
<div class="clearfix">
    <b class="btn pull-left" style="cursor: default;">
        produtos
    </b>
</div>
@endsection

@section('content')
<small class="text-danger">* campos obrigatórios</small>

<form class="form-horizontal" role="form" method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data" id="validate">
    {!! csrf_field() !!}

    <div class="form-group">
        <label class="col-md-3 control-label"><small class="text-danger">*</small> Título</label>
        <div class="col-md-5">
            <input 
                type="text" 
                class="form-control" 
                name="title" 
                value="{{ old('title') }}" 
                required 
                minlength="3">
        </div>
    </div>        

    <div class="form-group">
        <label class="col-md-3 control-label"><small class="text-danger">*</small> Subtítulo</label>
        <div class="col-md-6">
            <input 
                type="text" 
                name="subtitle" 
                class="form-control" 
                placeholder="" 
                value="{{ old('subtitle') }}" 
                id="price" 
                required>
        </div>
    </div>      

    <div class="form-group">
        <label class="col-md-3 control-label"><small class="text-danger">*</small> Conteúdo</label>
        <div class="col-md-7">
            <textarea 
                class="form-control ckeditor" 
                name="content" 
                rows="10" 
                required>{{ old('content') }}</textarea>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-md-3 control-label"><small class="text-danger">*</small> Imagem</label>
        <div class="col-md-5">
            <input 
                type="file"
                class="form-control" 
                name="image" 
                required>
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
                required>{{ old('tags') }}</textarea>
            <small class="text-danger">
                <i class="fa fa-exclamation-circle fa-fw"></i>
                de 3 a 4 palavras relacionadas separadas por vírgula.
            </small>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-7 col-md-offset-3">                
            <button type="submit" name="active" value="0" class="btn btn-primary">
                <i class="fa fa-thumbs-o-up"></i> salvar
            </button>
            <button type="submit" name="active" value="1" class="btn btn-success">
                <i class="fa fa-thumbs-o-up"></i> salvar e publicar
            </button>
        </div>
    </div>   
</form>


@stop

@push('scripts')
<script src="{{ url('/') }}/plugin/bootstrap-filestyle/src/bootstrap-filestyle.min.js"></script>  
<script src="{{ url('/') }}/plugin/bootstrap-select/dist/js/bootstrap-select.min.js"></script>  
<script src="{{ url('/') }}/plugin/ckeditor/ckeditor.js"></script>    
<script src="{{ url('/') }}/plugin/jquery-validation/dist/jquery.validate.min.js"></script>    
<script src="{{ url('/') }}/plugin/jquery-validation/src/localization/messages_pt_BR.js"></script>  
<script type="text/javascript">
$(function () {
    app.filestyle();   
    app.validate('form#validate');
});
</script>   
@endpush