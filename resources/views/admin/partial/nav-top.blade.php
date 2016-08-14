<ul class="nav navbar-top-links navbar-right">
   
    @if(\Auth::user()->role_id == 1)
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            Configurações  <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">    
            <li>
                <a href="{{ route('root.users.index') }}">
                    <i class="fa fa-user-secret fa-fw"></i> Usuários
                </a>
            </li>
             
        </ul>        
    </li>         
    @endif
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            {{ \Auth::user()->name }}  <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li>
                <a href="{{ route('admin.profile') }}"><i class="fa fa-edit fa-fw"></i> perfil</a>
            </li>            
            <li class="divider"></li>
            <li><a href="{{ route('auth.logout') }}"><i class="fa fa-sign-out fa-fw"></i> sair</a>
            </li>
        </ul>        
    </li>
    <!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->