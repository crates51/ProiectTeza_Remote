@extends('layouts.loginIndexLayout')

@section('content')
	<div class="h-100 d-flex justify-content-center align-items-center">
		<div class="d-flex justify-content-center align-items-center" id="ilpPanel">
            <form method="POST" action="{{ route('login') }}" id="target">
                @csrf
                <div class="form-group row">
                    {{-- <label for="email" class="col-sm-4 col-form-label ">{{ __('keywords.email') }}</label> --}}
                    <div class="col-md-12">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('keywords.email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    {{-- <label for="password" class="col-md-4 col-form-label ">{{ __('keywords.password') }}</label> --}}

                    <div class="col-md-12">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('keywords.password') }}" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('keywords.login') }}
                        </button>

                        <a class="btn btn-link" href="{{ route('password.request') }}" style=" filter: brightness(50%)">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                </div>
            </form>
		</div>
	</div>
@endsection

