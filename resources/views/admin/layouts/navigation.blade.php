<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">News Feed</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('dashboard.index')}}" class="nav-link {{Request::is('admin/dashboard') ? 'active':''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('categories.index')}}" class="nav-link {{Request::is('admin/categories') ? 'active':''}}">
                        <i class="nav-icon fa-solid fa-folder-open"></i>
                        <p>Category</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('subCategory.index')}}" class="nav-link {{Request::is('admin/subCategory*') ? 'active':''}}">
                        <i class="nav-icon fa-solid fa-folder-open"></i>
                        <p>Sub Category</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('articles.index')}}" class="nav-link {{Request::is('admin/articles*') ? 'active':''}}">
                        <i class="nav-icon fa-solid fa-cloud"></i>
                        <p>articles</p>
                    </a>
                </li>
                <li class="nav-header">Administrator</li>
                <li class="nav-item {{Request::is('admin/users*','admin/roles*','admin/languages*') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{Request::is('admin/users*','admin/roles*','admin/languages*') ? 'active' : ''}}">
                        <i class="nav-icon fa-solid fa-gears"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('users.index')}}" class="nav-link {{ Request::is('admin/users*') ? 'active cus_active ' : '' }}">
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('roles.index')}}" class="nav-link {{ Request::is('admin/roles*') ? 'active cus_active ' : '' }}">
                                <p>Roles</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('languages')}}" class="nav-link {{ Request::is('admin/languages*') ? 'active cus_active ' : '' }}">
                                <p>Language</p>
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
