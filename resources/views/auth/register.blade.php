<body>
    <header class="header_section">
        @include('welcome.content.navbar')
    </header>
    <main id="register-page" class="home page-content">
        <div class="register-page-container">
            <div class="register-form-container">
                <div class="registration-title">
                    <h1>{{ __('Register with') }}</h1>
                </div>
                <div>
                    <div>
                        <div class="meta-login-page" style="display: flex; gap: 20px; flex-wrap: wrap;">
                            <div class="custom-register-page login-google">
                                <a onclick="ouvrirFenetre(event); return false;" href="{{ route('auth.google') }}">
                                    <i class="fab fa-google"></i> {{ __('Register with google') }}
                                </a>
                            </div>
                            <div class="custom-register-page login-facebook">
                                <a onclick="ouvrirFenetre(event); return false;" href="{{ route('auth.facebook') }}">
                                    <i class="fab fa-facebook"></i> {{ __('Register with Facebook') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="registration-title">
                        <h2>{{ __('Or') }}</h2>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                            placeholder="Name">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email"
                            placeholder="Email adress">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password" placeholder="Password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password" placeholder="Confirm password">
                        <button type="submit" class="btn btn-primary"
                            style="width: 100%; padding: 10px;  color: white; margin: 10px 0px; border-radius: 8px; border: none; text-transform: uppercase;">
                            {{ __('Register') }}
                        </button>
                    </form>
                    <div>
                        <div class="register" style="text-align:center; margin-top: 25px;">
                            Already have an account?
                            <a href="{{route('login')}}">{{_('Login')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
    </footer>
</body>

</html>