@extends('auth.auth')

@section('auth')
<div class="col-md-6">
    <div class="card mx-4">
        <div class="card-body p-4">
            <h1>{{ __('Reset Password') }}</h1>
            <p class="text-muted">Reset you password</p>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">@</span>
                    </div>
                    <input id="nid" type="text" class="form-control{{ $errors->has('nid') ? ' is-invalid' : '' }}" name="nid" value="{{ old('nid') }}" placeholder="{{ __('Número de Identificación') }}" required autofocus>

                    @if ($errors->has('nid'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nid') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-key"></i>
                        </span>
                    </div>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"  placeholder="{{ __('Password') }}" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-key"></i>
                        </span>
                    </div>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required>
                </div>
                <button type="submit" class="btn btn-primary">
                    {{ __('Reset Password') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection