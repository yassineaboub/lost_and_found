<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="{{ url('/') }}"><img src="../images/logo/logo-white.png" alt=""
                class="logo"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ml-auto">

                @guest
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ url('log-in') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{route('utilisateur.index')}}">Register</a>
                </li>
                @else
                @if (Auth::user()->isAdmin())
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ url('admin') }}">Admin interface</a>
                </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="{{ url('lost') }}">Lost</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="{{ url('found') }}">Found</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="{{ url('search') }}">Search</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Users
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class=" dropdown-item nav-link js-scroll-trigger" href="{{ url('/edituser') }}">Edit
                                    Profile</a>
                                <a class="dropdown-item nav-link js-scroll-trigger" href="{{ url('mes-annonce') }}">List
                                    Annonce</a>

                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="{{url('/logout')}}">Déconnexion</a>
                        </li>
                        @endguest
            </ul>
        </div>
    </div>
</nav>