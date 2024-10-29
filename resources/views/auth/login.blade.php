<body>
    <header class="header_section">
        @include('welcome.content.navbar')
    </header>
    <main id="login-page">
        <div class="login-page-container">
            <div class="login-form-container">
                <span class="close" id="close-login-popup">&times;</span>
                <div class="login-title">
                    <h1>{{ __('Login with') }}</h1>
                </div>
                <div class="meta-login-page">
                    <div class="custom-login-page login-google">
                        <a onclick="ouvrirFenetre(event); return false;" href="{{ route('auth.google') }}"
                            style="text-decoration: none;">
                            <i class="fab fa-google"></i> {{ __('Login with Google') }}
                        </a>
                    </div>
                    <div class="custom-login-page login-facebook">
                        <a onclick="ouvrirFenetre(event); return false;" href="{{ route('auth.facebook') }}"
                            style="text-decoration: none;">
                            <i class="fab fa-facebook"></i> {{ __('Login with Facebook') }}
                        </a>
                    </div>
                </div>
                <div class="login-title">
                    <h2>{{ __('Or') }}</h2>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                        placeholder="E-mail Adress">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password" placeholder="Password">

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
                                <a class="btn btn-link password-reset" href="{{ route('password.request') }}"
                                    style="text-decoration: none;">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
                <div>
                    <div class="register" style="text-align:center; margin-top: 25px;">
                        Don't have account?
                        <a href="{{route('register')}}">{{_('Create now')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>

    </footer>
</body>

</html>