<div class="sidebar-brand" style="background: #ffffff;padding-bottom: 7px;">
    <a href="{{ url('apps') }}" class="text-center">
        <div class="text-center">
        <h5 class="mt-3 brand-text" style="color: red;">Capture</h5></div>
    </a>
</div>
<div class="sidebar campus-sidebar">
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @if (Request::Cookie('appId') == null)
                <li class="nav-item">
                    <a href="{{ route('apps.index') }}" class="nav-link {{ Request::is('app*') ? 'active1' : '' }}">
                        <i class="fa-solid fa-user-group nav-icon"></i>
                        <p>Apps</p>
                    </a>
                </li>
                @can('app-setting-access')
                    <li class="nav-item">
                        <a href="{{ route('app.settings') }}"
                            class="nav-link {{ Request::is('payment-setting') ? 'active1' : '' }}">
                            <i class="fa-solid fa-gear nav-icon"></i>
                            <p>Settings</p>
                        </a>
                    </li>
                @endcan
                @can('role-access')
                    <li class="nav-item">
                        <a href="{{ route('role') }}" class="nav-link {{ Request::is('role') ? 'active1' : '' }}">
                            <i class="fa-sharp fa-solid fa-key nav-icon"></i>
                            <p>Roles</p>
                        </a>
                    </li>
                @endcan
                @can('permission-access')
                    <li class="nav-item">
                        <a href="{{ route('permission') }}" class="nav-link {{ Request::is('permission') ? 'active1' : '' }}">
                            <i class="fa-sharp fa-solid fa-key nav-icon"></i>
                            <p>Permission</p>
                        </a>
                    </li>
                @endcan
                @can('authentication')
                <li class="nav-item">
                    <a href="{{ route('authe') }}" class="nav-link {{ Request::is('authentication') ? 'active1' : '' }}">
                        {{-- <i class="fa-sharp fa-solid fa-key nav-icon"></i> --}}
                        <i class="fa-sharp fa-solid fa-unlock nav-icon"></i>
                        <p>Authentication</p>
                    </a>
                </li>
                @endcan
            @else
                <li class="nav-item">
                    <a href="{{ route('purchage') }}" class="nav-link {{ Request::is('purchage') ? 'active1' : '' }}">
                        {{-- <i class="fa-solid fa-gauge nav-icon"></i> --}}
                        <i class="fa-sharp fa-solid fa-cart-shopping nav-icon"></i>
                        <p>purchage</p>
                    </a>
                </li>
                {{-- @can('setting-access') --}}
                    <li class="nav-item">
                        <a href="{{ route('users') }}" class="nav-link {{ Request::is('users*') ? 'active1' : '' }}">
                            <i class="fa-solid fa-users nav-icon"></i>
                            <p>User</p>
                        </a>
                    </li>
                {{-- @endcan --}}
                @can('setting-access')
                    <li class="nav-item">
                        <a href="{{ route('settings') }}" class="nav-link {{ Request::is('settings*') ? 'active1' : '' }}">
                            <i class="fa-solid fa-gear nav-icon"></i>
                            <p>Settings</p>
                        </a>
                    </li>
                @endcan
            @endif
        </ul>
    </nav>
</div>
