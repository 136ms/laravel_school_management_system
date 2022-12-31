@can('dashboard_access')
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home text-orange"></i>
            <p>Dashboard</p>
        </a>
    </li>
@endcan
@can('users_access')
    <li class="nav-item">
        <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-user text-lime"></i>
            <p>Users</p>
        </a>
    </li>
@endcan
@can('subjects_access')
    <li class="nav-item">
        <a href="{{ route('subjects.index') }}" class="nav-link {{ Request::is('subjects*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-book text-purple"></i>
            <p>Subjects</p>
        </a>
    </li>
@endcan
@can('groups_access')
    <li class="nav-item">
        <a href="{{ route('groups.index') }}" class="nav-link {{ Request::is('groups*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users text-info"></i>
            <p>Groups</p>
        </a>
    </li>
@endcan
