@extends('admin')

@section('title', 'Usuários')

@section('actions')
    <div class="clearfix">
        <b class="btn pull-left" style="cursor: default;">
            usuários
        </b>
    </div>
@endsection

@section('content')

<small class="text-danger">* campos obrigatórios</small>

<form class="form-horizontal" role="form" method="POST" action="{{ route('root.users.store') }}" id="validate">
    {!! csrf_field() !!}

    <div class="form-group">
        <label class="col-md-4 control-label"><small class="text-danger">*</small> Nome</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="name" value="" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label"><small class="text-danger">*</small> Email</label>
        <div class="col-md-6">
            <input type="email" class="form-control" name="email" value="" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label"><small class="text-danger">*</small> Senha</label>
        <div class="col-md-6">
            <input type="password" class="form-control" name="password" id="password" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label"><small class="text-danger">*</small> Repita Senha</label>
        <div class="col-md-6">
            <input type="password" class="form-control" name="password_confirmation" required equalTo="#password">
        </div>
    </div>    

    <div class="form-group">
        <label class="col-md-4 control-label"><small class="text-danger">*</small> Nível</label>
        <div class="col-md-6">
            <div class="radio">
              <label><input type="radio" name="role_id" value="2">Administrador</label>
            </div>
            <div class="radio">
              <label><input type="radio" name="role_id" value="3" checked="checked">Editor</label>
            </div>       
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">            
            <button type="submit" class="btn btn-success">
                <i class="fa fa-check"></i> salvar dados
            </button>
        </div>
    </div>
</form>


@stop

@push('scripts')  
<script src="{{ url('/') }}/plugin/jquery-validation/dist/jquery.validate.min.js"></script>    
<script src="{{ url('/') }}/plugin/jquery-validation/src/localization/messages_pt_BR.js"></script>       
<script>
$(function () {
app.validate('form#validate');
})
</script>
@endpush