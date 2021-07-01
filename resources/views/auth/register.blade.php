@extends('layouts.app')

@section('content')
    <div class="container-login">
        <div class="row-login">
            <div class="pic-login">
                <img src="/images/img-01.png" alt="IMG">
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <span class="login-title">Register</span>
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <div class="wrap-input">
                        <input
                                id="name"
                                type="text"
                                class="input"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Name"
                                required
                        >
                        <span class="input-focus"></span>
                        <span class="input-icon">
                            <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                        </span>
                        @error('name')
                        <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="wrap-input{{ $errors->has('login') ? ' has-error' : '' }}">
                    <input
                            id="login"
                            type="text"
                            class="input"
                            name="login"
                            value="{{ old('login') }}"
                            placeholder="Login"
                            required
                    >
                    <span class="input-focus"></span>
                    <span class="input-icon">
                         <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                    </span>
                    @error('login')
                    <span class="help-block">
                             <strong>{{ $message }}</strong>
                        </span>
                    @endif
                </div>

                <div class="wrap-input {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input
                            id="email"
                            type="email"
                            class="input"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Email"
                            required
                    >
                    <span class="input-focus"></span>
                    <span class="input-icon">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                    @error('email')
                    <span class="help-block">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="wrap-input{{ $errors->has('password') ? ' has-error' : '' }}">
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

                    @error('password')
                    <span class="help-block">
                             <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="wrap-input">
                    <input
                            id="password-confirm"
                            type="password"
                            class="input"
                            name="password_confirmation"
                            placeholder="Password confirmation"
                            required
                    >
                    <span class="input-focus"></span>
                    <span class="input-icon">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="wrap-login-btn">
                    <button type="submit" class="login-btn">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
