<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">

    <title>Admin | @yield('title')</title>

    <link href="{{ url('/') }}" rel="nofollow" title="baseurl" />

    <!-- Bootstrap Core CSS -->
    <link href="{{ url('/') }}/plugin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ url('/') }}/plugin/metisMenu/dist/metisMenu.min.css" rel="stylesheet">   

    <!-- Custom CSS -->
    <link href="{{ url('/') }}/css/sb-admin-2.css" rel="stylesheet">    
 
    <!-- Custom Fonts -->
    <link href="{{ url('/') }}/plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    @push('styles')
    @show

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="{{ url('/') }}/plugin/html5shiv/dist/html5shiv.min.js"></script>
        <script src="{{ url('/') }}/plugin/respond/dest/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div id="load"></div>

        <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand logo-panel" href="{{ route('admin.dashboard') }}">
                     Painel Twd
                </a>
            </div>
            <!-- /.navbar-header -->

            <!-- partial -->
            @include('admin.partial.nav-top')

            @include('admin.partial.sidebar')
            <!-- / partial -->


        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">

        <!-- @yield('breadcrumb') -->       
        
            <div class="container-fluid">            

                <div class="row">
                    <div class="col-lg-12">     

                    <br>                

                    @include('admin.partial.alert')                       

                        <div class="panel panel-default">
                            <div class="panel-heading">                                
                                @yield('actions')
                            </div>

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

                                @yield('content')
                            </div>  

                            @yield('content-footer')
                            
                        </div>

                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{ url('/') }}/plugin/jquery/dist/jquery.min.js"></script>   

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ url('/') }}/plugin/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ url('/') }}/plugin/metisMenu/dist/metisMenu.min.js"></script>    
    
    <!-- Custom Theme JavaScript -->
    <script src="{{ url('/') }}/js/sb-admin-2.js"></script>
    <script src="{{ url('/') }}/js/app.js"></script>

    @push('scripts')
    @show

    

</body>

</html>

