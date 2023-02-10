@can('dashboard_access')
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home text-orange"></i>
            <p>{{__('main.dashboard')}}</p>
        </a>
    </li>
@endcan
@can('users_access')
    <li class="nav-item">
        <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-user text-lime"></i>
            <p>{{__('main.users')}}</p>
        </a>
    </li>
@endcan
@can('subjects_access')
    <li class="nav-item">
        <a href="{{ route('subjects.index') }}" class="nav-link {{ Request::is('subjects*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-book text-purple"></i>
            <p>{{__('main.subjects')}}</p>
        </a>
    </li>
@endcan
@can('groups_access')
    <li class="nav-item">
        <a href="{{ route('groups.index') }}" class="nav-link {{ Request::is('groups*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users text-info"></i>
            <p>{{__('main.groups')}}</p>
        </a>
    </li>
@endcan
@can('grades_access')
    <li class="nav-item">
        <a href="{{ route('grades.index') }}" class="nav-link {{ Request::is('grades*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-graduation-cap text-yellow"></i>
            <p>{{__('main.grades')}}</p>
        </a>
    </li>
@endcan

@can('children_access')
    <li class="nav-item">
        <a href="{{ route('children.index') }}" class="nav-link {{ Request::is('children*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-child text-pink"></i>
            <p>{{__('main.children')}}</p>
        </a>
    </li>
@endcan
