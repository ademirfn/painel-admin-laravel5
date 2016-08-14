<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex, nofollow">
	<title>WMakers Autenticação</title>

	<!-- BASE URL DO SISTEMA -->
	<link href="{{ url('/') }}" rel="nofollow" title="baseurl" />

	<link href="{{ url('/') }}/plugin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="{{ url('/') }}/plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="{{ url('/') }}/css/app.css" rel="stylesheet" type="text/css">

	<!-- Fonts
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	-->
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style>
		*{
			border-radius: 0 !important;			
		}
		#feedSuccess, #feedDanger{
			display: none;
		}
		.loading{
			display: none;
			width: 100%;
			height: 100%;
			position: fixed;
			top: 0;
			z-index: 99;
			background-color: rgba(0,0,0,.5);
		}
		.loading > p{
			width: 100%;
			text-align: center;
			color: #fff;			
			padding: 10px 0;
		}
	</style>
</head>
<body>
<div class="loading">
	<div class="progress">
  <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar"
  aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
    
  </div>
</div>
</div>
	<div style="margin-bottom: 100px; display: block;"></div>

	@yield('content')

	<!-- Scripts -->
	<script src="{{ url('/') }}/plugin/jquery/dist/jquery.min.js"></script>
	<script src="{{ url('/') }}/plugin/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="{{ url('/') }}/js/app.js"></script>

	@section('scripts')
	@show

</body>
</html>
