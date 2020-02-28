<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand logo-font" href="#" id="brand">
            Webmx
        </a>
        <!-- links toggle -->
        <button class="navbar-toggler order-first" type="button" data-toggle="collapse" data-target="#links"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>
        <!-- account toggle -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#account"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-shopping-cart fa-1x" aria-hidden="true"></i>
            <span class="badge badge-light">88</span>
        </button>

        <div class="collapse navbar-collapse" id="links">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        Dishes
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Chicken</a>
                        <a class="dropdown-item" href="#">Mutton/Lamb/Beef 2</a>
                        <a class="dropdown-item" href="#">Deserts</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Recipies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>

            </ul>
        </div>
        <div class="collapse navbar-collapse" id="account">
            @guest
                <ul class="navbar-nav ml-auto pt-3">
                    <li class="nav-item">
                        <p class="navbar-text">Already have an account?</p>
                    </li>
                    <li class="nav-item dropdown guest">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Login
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <div class="row">
                                <div class="col-md-12">
                                    Login via
                                    <div class="social-buttons">
                                        <a href="#" class="btn btn-fb"><i class="fa fa-facebook"></i> Facebook</a>
                                        <a href="#" class="btn btn-tw"><i class="fa fa-twitter"></i> Twitter</a>
                                    </div>
                                    or
                                    <form class="form" role="form" method="post" action="{{ route('login') }}"
                                          accept-charset="UTF-8"
                                          id="login-nav">
                                        @csrf
                                        <div class="form-group">
                                            <label class="sr-only" for="email2">
                                                Nom D'utilisateur ou Adresse Email
                                            </label>
                                            <input type="text" class="form-control" name="email" id="email2"
                                                   placeholder="Nom D'utilisateur ou Adresse Email">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="password2">Mot de passe</label>
                                            <input type="password" name="password" class="form-control" id="password2"
                                                   placeholder="Mot de passe">
                                            <div class="help-block text-right">
                                                <a href="{{ route('password.request') }}">Mot de passe oublié?</a>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Se connecter
                                            </button>
                                        </div>
                                        <div class="checkbox pl-2">
                                            <label>
                                                <input type="checkbox" name="remember" class="form-check-input"
                                                       id="remember" {{ old("remember") ? 'checked' : '' }}>
                                                keep me logged-in
                                            </label>
                                        </div>
                                    </form>
                                </div>
                                <div class="bottom text-center">
                                    nouvel utilisateur? <a href="{{ route('register') }}"><b>Créer un nouveau compte</b></a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            @else
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown nav-icon">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" href="#"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-envelope"></i>
                            <span class="nav-notif">25</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-label="navbarDropdownMenuLink">
                            <a href="#" class="dropdown-item">alpha</a>
                            <a href="#" class="dropdown-item">beta</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">omega</a>
                        </div>

                    </li>
                    <li class="nav-item dropdown nav-icon">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" href="#"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <span class="nav-notif">25</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-label="navbarDropdownMenuLink">
                            <a href="#" class="dropdown-item">alpha</a>
                            <a href="#" class="dropdown-item">beta</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">omega</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle user-action" href="#" id="navbarDropdownMenuLink"
                           role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="http://webmx2018.me/img/profil/default.jpg" class="avatar" alt="Avatar">
                            {{Auth::user()->present()->fullName}}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right auth" aria-labelledby="navbarDropdownMenuLink">
                            <div class="dropdown-menu-content">
                                <div class="row">
                                    <div class="col-5">
                                        <img src="http://webmx2018.me/img/profil/default.jpg" alt="{{Auth::user()->username}}"
                                             class="img-fluid">
                                    </div>
                                    <div class="col-7">
                                        <span>{{Auth::user()->username}}</span>
                                        <p class="text-muted small">
                                            {{Auth::user()->email}}
                                        </p>
                                        <div class="divider"></div>
                                        <a href="{!! route("user", ["user" => Auth::user()->username])!!}"
                                           class="btn btn-primary btn-block">
                                            View Profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-menu-footer">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="http://webmx2018.me/panel" class="btn btn-light btn-block">Admin</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('logout') }}" class="btn btn-light btn-block"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            @endguest
        </div>
    </div>
</nav>
