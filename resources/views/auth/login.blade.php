@extends('layouts.app')

@section('content')
<div class="container background_form">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card card_title">
                <div class="card-header card_head">{{ __('Login') }}</div>

                <div class="card-body form_log">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row pb-2">
                            <label for="email" class="col-md-6 col-form-label text-md-right title_input">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6 input_value">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pb-2">
                            <label for="password" class="col-md-6 col-form-label text-md-right title_input">{{ __('Password') }}</label>

                            <div class="col-md-6 input_value">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pb-2">
                            <div class="col-md-6 title_input">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-8 title_input">
                                <button type="submit" class="button_log">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
