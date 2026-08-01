<form class="form-inline ml-3">
    <div class="input-group input-group-sm">
        <input class="form-control border-left-0" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-prepend">
            <span class="input-group-text bg-white border-right-0">
                <i class="fas fa-search"></i>
            </span>
        </div>
    </div>
</form>

{{-- EVERYONE: Students, Teacher, Admin --}}
<li class="nav-item">
    <a href="{{ route('courses.index') }}"
       class="nav-link {{ Request::is('courses*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-book"></i>
        <p>Browse Courses</p>
    </a>
</li>

{{-- STUDENT ONLY --}}
@if(Auth::user()->role_id == 4)
<li class="nav-item">
<a href="{{ route('courses.index', ['my' => 1]) }}"
           class="nav-link {{ Request::is('my-courses*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-graduation-cap"></i>
        <p>My Courses</p>
    </a>
</li>
@endif

{{-- TEACHER + ADMIN ONLY --}}
@if(Auth::user()->role_id < 4)
<li class="nav-item">
    <a href="{{ route('categories.index') }}"
       class="nav-link {{ Request::is('categories*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-folder"></i>
        <p>Course Categories</p>
    </a>
</li>
@endif

{{-- ADMIN ONLY --}}
@if(Auth::user()->role_id < 3)
<li class="nav-item">
    <a href="{{ route('courseUsers.index') }}"
       class="nav-link {{ Request::is('courseUsers*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-graduate"></i>
        <p>Subscriptions</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('coupons.index') }}"
       class="nav-link {{ Request::is('coupons*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-ticket-alt"></i>
        <p>Coupons</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('comments.index') }}"
       class="nav-link {{ Request::is('comments*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-comments"></i>
        <p>Comments</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('payments.index') }}"
       class="nav-link {{ Request::is('payments*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-money-bill"></i>
        <p>Payments</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('users.index') }}"
       class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Users</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('roles.index') }}"
       class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-shield"></i>
        <p>Roles</p>
    </a>
</li>
@endif