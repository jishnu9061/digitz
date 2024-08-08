<div class="sidebar">
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('user.tasks.index') }}"
                    class="nav-link {{ request()->is('dashboard') || request()->is('dashboard/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="javascript:;"
                    class="nav-link {{ request()->is('task') || request()->is('task/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tasks"></i>
                    <p>{{ __('Task') }}</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.logout') }}"
                    onclick="event.preventDefault();if(confirm('Are you sure you want to logout?')) document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt nav-icon"></i>
                    <p>{{ __('Logout') }}</p>
                </a>
                <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
</div>
