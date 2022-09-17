<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"> Admin</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}">
        <a class="nav-link" href="/"><i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span></a>
    </li>

     <li class="nav-item {{ (request()->is('create/account')) ? 'active' : '' }}">
        <a class="nav-link" href="/create/account"><i class="fas fa-fw fa-tachometer-alt"></i><span>Create Account</span></a>
    </li>

</ul>