<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <ul class="app-menu">
        @can('dashboard-sidebar')
            <li>
                <a class="app-menu__item {{ Request::segment(2) == 'dashboard'  ? 'active' : ''}}" href="{{route('dashboard')}}">
                    <i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span>
                </a>
            </li>
        @endcan
        @can('user-sidebar')
            <li>
                <a class="app-menu__item {{ Request::segment(2) == 'users'  ? 'active' : ''}}" href="{{route('users.index')}}">
                    <i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">User List</span>
                </a>
            </li>
        @endcan
    </ul>
</aside>
