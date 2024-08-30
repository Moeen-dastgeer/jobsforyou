<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <img src="{{ asset('web/images/favicon/favicon-32x32.png') }}"
            class="brand-image img-circle elevation-3">
        <span class="brand-text fw-bold ">{{config('app.name')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth()->user()->name}}</a>
            </div>
        </div>

        

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('admin.dashboard')}}" class="nav-link {{ Route::is('admin.dashboard')? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.candidates')}}" class="nav-link {{ Route::is('admin.candidates.*')? 'active' : '' }}">
                        <i class="nav-icon fa fa-users"></i>
                        <p>Candidates</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.companies')}}" class="nav-link {{ Route::is('admin.companies.*')? 'active' : '' }}">
                        <i class="nav-icon fa fa-list"></i>
                        <p>Companies</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.jobcategories.index')}}" class="nav-link {{ Route::is('admin.jobcategories.*')? 'active' : '' }}">
                        <i class="nav-icon fa fa-list"></i>
                        <p>Job Categories</p>
                    </a>
                </li>
                 <li class="nav-item">
                    <a href="{{route('admin.quizzes.index')}}" class="nav-link {{ Route::is('admin.quizzes.*')? 'active' : '' }}">
                        <i class="nav-icon fa fa-list"></i>
                        <p>Quizzes</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.change.password')}}" class="nav-link {{ Route::is('admin.change.password')? 'active' : '' }}">
                        <i class="nav-icon fas fa-key"></i>
                        <p>Change Password</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.logout')}}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="{{route('admin.logout')}}" method="POST" style="display: none;">@csrf</form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
