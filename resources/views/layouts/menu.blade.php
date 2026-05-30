<form class="form-inline ml-3">
    <div class="input-group input-group-sm">

        <input class="form-control border-left-0"
               type="search"
               placeholder="Search"
               aria-label="Search">

                <div class="input-group-prepend">
            <span class="input-group-text bg-white border-right-0">
                <i class="fas fa-search"></i>
            </span>
        </div>
    </div>
</form>
<li class="nav-item">
    <a href="{{ route('categories.index') }}"
       class="nav-link {{ Request::is('categories*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-folder"></i>
        <p>Categories</p>
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
    <a href="{{ route('courses.index') }}"
       class="nav-link {{ Request::is('courses*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-book"></i>
        <p>Courses</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('courseUsers.index') }}"
       class="nav-link {{ Request::is('courseUsers*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-graduate"></i>
        <p>Course Users</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('items.index') }}"
       class="nav-link {{ Request::is('items*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list"></i>
        <p>Items</p>
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
    <a href="{{ route('views.index') }}"
       class="nav-link {{ Request::is('views*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-eye"></i>
        <p>Views</p>
    </a>
</li>