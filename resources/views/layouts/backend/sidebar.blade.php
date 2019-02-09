<aside class="main-sidebar sidebar-light-info elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">MY <strong>BLOG</strong></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/img/240px-user_icon.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('edit-account') }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ $activeMenuItem == 'Dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                @if(check_user_permission(request(), "Users@index"))
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link {{ $activeMenuItem == 'Users' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-pen"></i>
                        <p>
                            Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview pl-2">
                        <li class="nav-item">
                            <a href="{{ route('backend.users.index') }}"
                               class="nav-link {{ $activeMenuSubItem == 'All Users' ? 'active' : '' }}">
                                <i class="fas fa-users nav-icon"></i><p>All Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('backend.users.create') }}"
                               class="nav-link {{ $activeMenuSubItem == 'Add User' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i><p>Add user</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                @if(check_user_permission(request(), "Categories@index"))
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link {{ $activeMenuItem == 'Categories' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-pen"></i>
                        <p>
                            Categories
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview pl-2">
                        <li class="nav-item">
                            <a href="{{ route('backend.categories.index') }}"
                               class="nav-link {{ $activeMenuSubItem == 'All Categories' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i><p>All Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('backend.categories.create') }}"
                               class="nav-link {{ $activeMenuSubItem == 'Add Category' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i><p>Add category</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link {{ $activeMenuItem == 'Blog' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-pen"></i>
                        <p>
                            Blog
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview pl-2">
                        <li class="nav-item">
                            <a href="{{ route('backend.blog.index') }}"
                               class="nav-link {{ $activeMenuSubItem == 'All Posts' ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i><p>All posts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('backend.blog.create') }}"
                               class="nav-link {{ $activeMenuSubItem == 'Add Post' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i><p>Add post</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-dashboard"></i>
                        <p>
                            Starter Pages
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Active Page</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Inactive Page</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-th"></i>
                        <p>
                            Simple Link
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

