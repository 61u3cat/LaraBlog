<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset('assets/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('assets/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                @if(Auth::check())
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                @else
                <a href="#" class="d-block">Guest</a>
                @endif
            </div>
            @if(Auth::check())
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
            @endif
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Posts Section -->
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('editor.view') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Posts
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('editor.view') }}" class="nav-link {{ request()->routeIs('editor.view') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Posts</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('category.view') }}" class="nav-link {{ request()->routeIs('category.view') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add category</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Lists Section -->
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('lists') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Lists
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('lists') }}" class="nav-link {{ request()->routeIs('lists') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('lists') }}" class="nav-link {{ request()->routeIs('lists') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Posts</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>