@extends('admin')

@section('title', 'Usuários')

@section('actions')
    <div class="clearfix">
        <b class="btn pull-left" style="cursor: default;">
            usuários
        </b>
        <div class="pull-right">
            <a href="{{ route('root.users.details', ['id'=>$user->id]) }}" class="btn btn-link">
                voltar
            </a>            
        </div>
    </div>
@endsection

@section('content')

<div class="dataTable_wrapper">

<form class="form-horizontal" role="form" method="POST" action="{{ route('root.users.update') }}" id="validate">
    {!! csrf_field() !!}
    
    <input type="hidden" name="id" value="{{ $user->id }}"/>

    <div class="form-group">
        <label class="col-md-4 control-label">Nome</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="name" value="{{$user->name}}" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Email</label>
        <div class="col-md-6">
            <input type="email" class="form-control" name="email" value="{{$user->email}}" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Senha</label>
        <div class="col-md-6">
            <input type="password" class="form-control" name="password" id="password" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Repita Senha</label>
        <div class="col-md-6">
            <input type="password" class="form-control" name="password_confirmation" required equalTo="#password">
        </div>
    </div>

    <div class="form-group">
    <label class="col-md-4 control-label">Nível</label>
        <div class="col-md-6">
            <div class="radio">
                <label><input type="radio" name="role_id" value="2" @if($user->role_id == 2) checked @endif>Administrador</label>
            </div>
            <div class="radio">
                <label><input type="radio" name="role_id" value="3" @if($user->role_id == 3) checked @endif>Editor</label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">            
            <button type="submit" class="btn btn-success">
                <i class="fa fa-thumbs-o-up"></i> salvar alterações
            </button>
        </div>
    </div>
</form>

</div>

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
