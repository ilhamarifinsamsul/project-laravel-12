<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow
-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                    <a href="{{ url('/') }}" class="nav-link">Home</a>
                </li>

                <li class="nav-item {{ request()->is('products*') ? 'active' : '' }}">
                    <a href="#" class="nav-link">Products</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a href="{{ route('auth.login') }}" class="btn btn-outline-light">
                            <i class="fas fa-sign-in"></i>Login
                        </a>
                    </li>
                    @else
                    <li class="nav-item dropdown">
                        <a href="#" id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="#" class="dropdown-item">Profil</a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('auth.logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form action="{{ route('auth.logout') }}" method="POST" class="d-none" id="logout-form">@csrf</form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>