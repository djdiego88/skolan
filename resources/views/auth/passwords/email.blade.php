@extends('auth.auth')

@section('auth')
<div class="col-md-6">
    <div class="card mx-4">
        <div class="card-body p-4">
            <h1>{{ __('Reset Password') }}</h1>
            <p class="text-muted">{{ __('Reset you password') }}</p>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text">@</span>
                    </div>
                    <input id="nid" type="text" class="form-control{{ $errors->has('nid') ? ' is-invalid' : '' }}" name="nid" value="{{ old('nid') }}" placeholder="{{ __('Número de Identificación') }}" required>

                    @if ($errors->has('nid'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nid') }}</strong>
                        </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ __('Send Password Reset Link') }}
                </button>

                @if (session('status'))
                    <div class="alert alert-success mt-4" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection