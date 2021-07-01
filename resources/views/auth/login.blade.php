@extends('layouts.app')

@section('content')
    <div class="container-login">
        <div class="row-login">
            <div class="pic-login">
                <img src="/images/img-01.png" alt="IMG">
            </div>
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <span class="login-title">Login</span>

                <div class="wrap-input {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input
                            id="email"
                            type="email"
                            class="input"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Email"
                            required
                            autofocus
                    >
                    <span class="input-focus"></span>
                    <span class="input-icon">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif

                </div>

                <div class="wrap-input {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input
                            id="password"
                            type="password"
                            class="input"
                            name="password"
                            placeholder="Password"
                            required
                    >
                    <span class="input-focus"></span>
                    <span class="input-icon">
                          <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="wrap-input">
                    <div class="checkbox-input">
                        <label>
                            <input
                                    type="checkbox"
                                    name="remember"
                                    {{ old('remember') ? 'checked' : '' }}
                            >
                            Remember Me
                        </label>
                    </div>
                </div>

                <div class="wrap-login-btn">
                    <button type="submit" class="login-btn">
                        Login
                    </button>
                </div>
                <div class="wrap-reset-pass">
                    <a href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>
                </div>

                <div class="link-create-account">
                    <a href="{{ route('register') }}">
                        {{__('navs.frontend.register')}}
                        <i class="fas fa-long-arrow-alt-right"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
