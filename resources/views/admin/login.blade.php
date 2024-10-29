
    <title>Admin Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div>
        <div>
            <div>
                <div>
                    <div>{{ __('Admin Login') }}</div>
                    <div>
                        <form method="POST" action="{{ route('admin.login.post') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="email">{{ __('Email Address') }}</label>
                                <div>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password">{{ __('Password') }}</label>
                                <div>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                        <span role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <div>
                                    <div>
                                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label for="remember">{{ __('Remember Me') }}</label>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div>
                                    <button type="submit">{{ __('Login') }}</button>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                                    @endif
                                </div>
                            </div>
                        </form>
                        <div>
                            <div>
                                <a href="{{ route('admin.register') }}"><i></i>{{ __('Register') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

