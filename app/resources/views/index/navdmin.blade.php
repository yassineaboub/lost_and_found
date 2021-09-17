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
              

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Question/Reponse
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class=" dropdown-item nav-link js-scroll-trigger" href="{{ url('question') }}">Edit
                            Question</a>
                        <a class="dropdown-item nav-link js-scroll-trigger" href="{{ url('reponse') }}">Edit Reponse</a>
                      
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categorie/Objet
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class=" dropdown-item nav-link js-scroll-trigger" href="{{ url('category') }}">Edit
                            categories</a>
                        <a class="dropdown-item nav-link js-scroll-trigger" href="{{ url('objet') }}">Edit objet</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ url('list-user') }}">list user</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ url('signal-liste') }}">Signaler</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{url('/logout')}}">Déconnexion</a>
                </li>

            </ul>
        </div>
    </div>
</nav>