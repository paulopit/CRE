@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="col-md-12 text-center">
                            <img src="/storage/img/logo_cesae.png" width="500px" class="mb-3 align-items-center"></img>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-10 offset-md-1 col-form-label">{{ __('Name') }}</label>

                            <div class="col-md-10 offset-md-1">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-10 offset-md-1 col-form-label">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-10 offset-md-1">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-10 offset-md-1 col-form-label">{{ __('Password') }}</label>

                            <div class="col-md-10 offset-md-1">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-10 offset-md-1 col-form-label">{{ __('Confirm Password') }}</label>

                            <div class="col-md-10 offset-md-1">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-4">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-color col-md-10">
                                    {{ __('Register') }}
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
