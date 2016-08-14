@extends('admin')

@section('title', 'Banners')

@push('styles')
<link href="{{ url('/') }}/plugin/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
@endpush

@section('actions')
<div class="clearfix">
    <b class="btn pull-left" style="cursor: default;">
        banners
    </b>
</div>
@endsection

@section('content')

<small class="text-danger">* campos obrigatórios</small>

<form class="form-horizontal" role="form" method="POST" action="{{ route('admin.banners.store') }}" enctype="multipart/form-data" id="validate">
    {!! csrf_field() !!}

    <div class="form-group">
        <label class="col-md-3 control-label"><small class="text-danger">*</small> Título</label>
        <div class="col-md-7">
            <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">Subtítulo</label>
        <div class="col-md-7">
            <input type="text" class="form-control" name="subtitle" value="{{ old('subtitle') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label"><small class="text-danger">*</small> Descrição</label>
        <div class="col-md-7">
            <textarea class="form-control" name="description" rows="6" required></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">Link</label>
        <div class="col-md-7">
            <input type="url" class="form-control" name="link" placeholder="http://clubedomateoficial.com.br/..." value="{{ old('link') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label"><small class="text-danger">*</small> Imagem</label>
        <div class="col-md-7">
            <div class="input-group">
                <input type="file" name="file" required>
            </div>
            <small class="text-danger">
                <i class="fa fa-exclamation-circle fa-fw"></i>
                tamanho recomendado: 1200 X 400px
            </small>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-7 col-md-offset-3">
            <button type="submit" name="active" value="N" class="btn btn-primary">
                <i class="fa fa-thumbs-o-up fa-fw"></i> salvar
            </button>
            <button type="submit" name="active" value="Y" class="btn btn-success">
                <i class="fa fa-check fa-fw"></i> salvar e publicar
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
$(function () {
app.filestyle();
app.validate('form#validate');
})
</script>
@endpush