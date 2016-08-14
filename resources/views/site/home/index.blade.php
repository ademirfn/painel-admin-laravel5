@extends('site')

@push('metas')	

	<title>Título dinâmico da página</title>
	<meta name="description" content="descrição da página com até 156 caracteres" />

	<!-- google plus -->
	<link rel="author" href="https://plus.google.com/perfil_proprietario">
	<link rel="publisher" href="https://plus.google.com/perfil_company">
	<link rel="canonical" href="url dinâmica pagina">
	<meta itemprop="name" content="nome site">
	<meta itemprop="description" content="descricao site">
	<meta itemprop="image" content="imagem padrao">
	<meta itemprop="url" content="url site">

	<!-- facebook -->
	<meta property="og:type" content="article">
	<meta property="og:title" content="titulo pagina">
	<meta property="og:description" content="descrição da página com até 156 caracteres">
	<meta property="og:image" content="img padrão pagina">
	<meta property="og:url" content="url site">
	<meta property="og:site_name" content="nome site">
	<meta property="og:locale" content="pt_BR">
	<meta property="og:app_id" content="">
	<meta property="article:author" content="">
	<meta property="article:publisher" content="">

	<!-- twitter -->
	<meta name="twitter:card" content="">
	<meta name="twitter:site" content="">
	<meta name="twitter:domain" content="">
	<meta name="twitter:title" content="">
	<meta name="twitter:description" content="">
	<meta name="twitter:image:src" content="">
	<meta name="twitter:url" content="">

@endpush

@section('content')

<a href="/auth/login" title="logar">Logar</a>

@endsection