<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fa fa-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-cog"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                    {{-- <a href="{{route("admin.settings.profile")}}" class="dropdown-item">
                        <i class="fa fa-user mr-2"></i> Profile
                    </a>
                     --}}
                    <a href="{{route('admin.change.password')}}" class="dropdown-item">
                        <i class="fa fa-key mr-2"></i> Change Password
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{route('admin.logout')}}" class="dropdown-item"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out-alt mr-2"></i> Logout
                    </a>
                    <form id="logout-form" action="{{route('admin.logout')}}" method="POST" style="display: none;">@csrf</form>
                </div>
            </li>
        </ul>
    </ul>
</nav>
