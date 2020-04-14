<div class="nav-left-sidebar sidebar-darkblue">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        Menu
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#dashboard" aria-controls="submenu-2"><i class="fa fa-fw fa-cogs"></i>Dashboard</a>
                        <div id="dashboard" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('target.index') }}">Spintax Collections</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-divider">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#profile" aria-controls="submenu-2"><i class="fa fa-fw fa-user-circle"></i>Account</a>
                        <div id="profile" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="#">Settings</a>
                                </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
