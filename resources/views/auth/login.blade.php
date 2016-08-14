@extends('app')

@section('title', 'Makers | Autenticação')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><i class="fa fa-lock fa-fw"></i> <b>Autenticação</b></div>
                <div class="panel-body">
                    @if (count(@$errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="alert alert-success text-center" id="feedSuccess"><p></p></div>
                    <div class="alert alert-danger text-center" id="feedDanger"><p></p></div>

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('auth.login') }}" id="validate">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-md-3 control-label">E-Mail</label>
                            <div class="col-md-7">
                                <input 
                                    type="email" 
                                    class="form-control" 
                                    name="email" 
                                    value="{{ old('email') }}"
                                    placeholder="email@email.com"
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Senha</label>
                            <div class="col-md-7">
                                <input 
                                    type="password" 
                                    class="form-control" 
                                    name="password"
                                    required
                                    minlength="6"
                                    maxlength="12">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Lembrar-me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <button type="submit" class="btn btn-success btn-block" id="submit">
                                    <i class="fa fa-thumbs-o-up fa-fw"></i> Logar
                                </button>
                            </div>
                            <br><br>
                            <div class="col-md-7 col-md-offset-3">
                                <a class="btn-link pull-left" href="{{ route('password.email') }}">Esqueceu sua senha?</a>                                
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <a class="btn-link pull-left" href="{{ url('/') }}">
                        <i class="glyphicon glyphicon-home"></i> Site</a>
                    <b class="pull-right">&copy; WMakers {{date('Y')}}</b>
                    <div style="clear: both"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script src="{{ url('/') }}/plugin/jquery-validation/dist/jquery.validate.min.js"></script>    
<script src="{{ url('/') }}/plugin/jquery-validation/src/localization/messages_pt_BR.js"></script>       
<script>
$(function () {
    app.validate('form#validate');
})
</script>
@endpush