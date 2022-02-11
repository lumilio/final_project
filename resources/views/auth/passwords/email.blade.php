@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center background_form">
        <div class="col-md-4">
            <div class="card card_title">
                <div class="card-header card_head">{{ __('Reset Password') }}</div>

                <div class="card-body form_log">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
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

                        <div class="form-group row mb-0">
                            <div class="col-md-6 title_input">
                                <button type="submit" class="btn button_link ">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
