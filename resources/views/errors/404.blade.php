@extends('store')

@push('metas')
    <meta name="_token" content="{{ csrf_token() }}" id="_token"/>
@endpush

@section('title', 'Clube do Mate | 404')

@section('content')

<section class="container internal error-page bg-white">
	<div class="row">
        <p><i class="fa fa-exclamation-triangle"></i></p>
		<h1>Desculpe, página indisponível!</h1>
        <h2>Verifique se está acessando o endereço corretamente.</h2>
        <h3>Em caso de dúvida <a href="{{ url('/contato') }}">clique aqui</a> e nos envie uma mensagem.</h3>
	</div>	
</section>

@endsection

@push('scripts')  
    <script>
        $(function(){            
           store.formHandler('form#contact', 'Mensagem enviada com sucesso!', function(){
                setTimeout(function(){
                    window.location.href = "{{ route('store') }}";
                },3500)
            });
        })
    </script>
@endpush