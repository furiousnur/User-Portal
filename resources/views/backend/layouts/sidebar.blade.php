<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <ul class="app-menu">
        <li>
            <a class="app-menu__item {{ Request::segment(2) == 'dashboard'  ? 'active' : ''}}" href="{{route('dashboard')}}">
                <i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        <li><a class="app-menu__item" href="javascript:void(0)"><i class="app-menu__icon fa fa-history"></i><span class="app-menu__label">Email</span></a></li>
    </ul>
</aside>
