<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Votre site</title>
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Poppins:400,700|Roboto:400,700&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/bootstrap-css.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/all.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/Login-registration.css')}}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap"
    rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{asset('assets/css/Login-registration.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/all.css')}}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="{{ asset('assets/js/app.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
</head>

<div class="container">

  <nav class="navbar navbar-expand-lg custom_nav-container ">
    <a class="navbar-brand" href="/">
      <span>Votre site</span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
        <ul class="navbar-nav menu-desktop">
          <li class="nav-item">
            <a class="nav-link" href="/">Accueil <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Ressources</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Cours <span style="margin-left: 5px;"><i
                  class="fas fa-chevron-down"></i></span></a>
            <ul class="sub-menu">
              <li class="nav-item"><a class="nav-link" href="#">Langue Japonais</a></li>
            </ul>
          </li>

          @if (Auth::check())
        <li class="nav-item">
        <a id="dashboard" class="btn-header login" href="#"><i class="fa fa-user"></i>Mon compte</a>
        </li>
        <li class="nav-item">
        <a id="logout" class="btn-header register" href="{{ route('logout') }}">Déconnexion</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
        </li>
      @else
      <li class="nav-item">
      <a id="login" class=" btn-header login"><span style="margin-right: 8px;"><i class="fa fa-user"></i></span>
        Connexion</a>
      </li>
      <li class="nav-item">
      <a id="register" class=" btn-header register">Inscription</a>
      </li>
    @endif
        </ul>
        <ul class="navbar-nav menu-mobile">
          <li class="nav-item">
            <a class="nav-link" href="/">Accueil <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Ressources</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Cours <span style="margin-left: 5px;"></span></a>
          </li>
          <li class="nav-item"><a class="nav-link" href="#">Langue Japonais</a></li>

          @if (Auth::check())
        <li class="nav-item">
        <a id="dashboard" class="nav-link" href="#">Mon compte</a>
        </li>
        <li class="nav-item">
        <a id="logout" class="nav-link" href="{{ route('logout') }}"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
        </li>
      @else
      <li class="nav-item">
      <a id="login" class="nav-link login" href="{{route('login')}}">Connexion</a>
      </li>
      <li class="nav-item">
      <a id="register" class="nav-link register" href="{{route('login')}}">Inscription</a>
      </li>
    @endif
        </ul>
      </div>
    </div>
  </nav>
</div>

<!-- Popup de Connexion -->
<div id="login-popup" class="popup">
  <div class="popup-content">
    <span class="close" id="close-login-popup">&times;</span>
    <div class="login-title">{{ __('Login') }}</div>
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
        value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-mail Adress">

      @error('email')
      <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
      </span>
    @enderror

      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
        required autocomplete="current-password" placeholder="Password">

      @error('password')
      <span role="alert">
      <strong>{{ $message }}</strong>
      </span>
    @enderror

      <button type="submit" class="btn btn-primary btn-submit">{{ __('Login') }}</button>
      <div class="submit-meta">
        <div class="remember-me">
          <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
          Remember me
        </div>
        <div>
          @if (Route::has('password.request'))
        <a class="btn btn-link password-reset" href="{{ route('password.request') }}" style="text-decoration: none;">
        {{ __('Forgot Your Password?') }}
        </a>
      @endif
        </div>
      </div>
    </form>
    <div class="meta-login">
      <div class="custom-login login-google">
        <a onclick="ouvrirFenetre(event); return false;" href="{{ route('auth.google') }}"
          style="text-decoration: none;">
          <i class="fab fa-google"></i> {{ __('Login with Google') }}
        </a>
      </div>
      <div class="custom-login login-facebook">
        <a onclick="ouvrirFenetre(event); return false;" href="{{ route('auth.facebook') }}"
          style="text-decoration: none;">
          <i class="fab fa-facebook"></i> {{ __('Login with Facebook') }}
        </a>
      </div>
    </div>
    <div>
      <div class="register" style="text-align:center; margin-top: 25px;">
        Don't have account?
        <a href="{{route('register')}}">{{_('Create now')}}</a>
      </div>
    </div>
  </div>
</div>

<!-- Popup d'Inscription -->
<div id="register-popup" class="popup">
  <div class="popup-content">
    <span class="close" id="close-register-popup">&times;</span>
    <div class="registration-title">{{ __('Register') }}</div>
    <form method="POST" action="{{ route('register') }}">
      @csrf
      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
        value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">

      @error('name')
      <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
      </span>
    @enderror

      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
        value="{{ old('email') }}" required autocomplete="email" placeholder="Email adress">

      @error('email')
      <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
      </span>
    @enderror

      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
        required autocomplete="new-password" placeholder="Password">

      @error('password')
      <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
      </span>
    @enderror

      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
        autocomplete="new-password" placeholder="Confirm password">
      <button type="submit" class="btn btn-primary btn-submit">{{ __('Register') }}</button>
    </form>
    <div class="meta-login">
      <div class="custom-login login-google">
        <a target="blank" href="{{ route('auth.google') }}">
          <i class="fab fa-google"></i> {{ __('Register with google') }}
        </a>
      </div>
      <div class="custom-login login-facebook">
        <a onclick="ouvrirFenetre(event); return false;" href="{{ route('auth.facebook') }}">
          <i class="fab fa-facebook"></i> {{ __('Register with Facebook') }}
        </a>
      </div>
    </div>
    <div class="register" style="text-align:center; margin-top: 25px;">
      Already have an account?
      <a href="{{route('login')}}">{{_('Login')}}</a>
    </div>
  </div>
</div>
