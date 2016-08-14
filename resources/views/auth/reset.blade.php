@extends('store')

@section('title', 'WMakers | Autenticação')

@section('content')

<section class="container login p0">
    <div class="row">		
        <!-- BEGIN NOVO CADASTRADO -->
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 xs-p0 col-md-offset-3">
            <div class="bg-white relative">
                <h1>Redefinir senha</h1>
                <form method="POST" action="{{ url('/password/reset') }}">
                    {!! csrf_field() !!}	

                    <input type="hidden" name="token" value="{{$token}}">			

                    <label>Digite seu e-mail:</label>
                    <input type="email" name="email" value="{{ old('email') }}"required>

                    <label>Nova senha:</label>
                    <input type="password" name="password" required>

                    <label>Repita senha:</label>
                    <input type="password" name="password_confirmation" required>

                    <button type="submit" class="btn-yellow">alterar</button>
                </form>

                @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                <p class="text-danger">{{ $error }}</p>
                @endforeach
                @endif				

            </div>

        </div>
        <!-- END NOVO CADASTRADO -->

    </div>
</section>

@endsection
