<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">            
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-dashboard fa-fw"></i> Dashboard
                </a>
            </li>                          
            <li>
                <a href="{{ route('admin.newsletter.index') }}">
                    <i class="fa fa-envelope fa-fw"></i> E-mails
                </a>
            </li>       
            @foreach(config('module.modules') as $m)
                @if ($m == 'Banners')
                <li>
                    <a href="{{ route('admin.banners.index') }}">
                        <i class="fa fa-flag fa-fw"></i> Banners
                    </a>
                </li> 
                @endif
                @if ($m == 'Blog')
                <li>
                    <a href="{{ route('admin.posts.index') }}">
                        <i class="fa fa-flag fa-fw"></i> Artigos
                    </a>
                </li> 
                @endif
            @endforeach
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
