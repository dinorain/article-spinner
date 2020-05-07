<nav class="navbar navbar-expand-lg bg-white fixed-top">
    @if (Auth::check())
        <a class="navbar-brand" href="{{ route('admin.index') }}">{{ config('app.name', 'ARCSPIN') }}</a>
    @else
        <a class="navbar-brand" href="{{ config('app.url', '/') }}">{{ config('app.name', 'ARCSPIN') }}</a>
    @endif
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    @if (Auth::check())
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto navbar-right-top">
                <li class="nav-item dropdown nav-user">
                    <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user mr-2"></i>{{ Auth::user()->username }}</a>
                    <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                        <div class="nav-user-info">
                            <h5 class="mb-0 text-white nav-user-name">{{ Auth::user()->username }}</h5>
                        </div>
                        <a class="dropdown-item" href="{{ route('account.personal.edit') }}"><i class="fas fa-id-card mr-2"></i>Edit Profile</a>
                        <a class="dropdown-item" href="{{ route('account.password.edit') }}"><i class="fas fa-cog mr-2"></i>Change Password</a>
                        <a class="dropdown-item" href={{ route('logout') }}><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    @else
    @endif
</nav>
