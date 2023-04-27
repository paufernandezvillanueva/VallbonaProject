@extends('layout')

@section('title', 'Llistat de users')

@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">
@endsection

@section('content')
    <div class="titulo">
        <h1>Perfil</h1>
    </div>
            <div class="row justify-content-center">
                <div class="col-md-8" style="width: 95%">
                    <div class="card">
                        <div class="card-header">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('user_update',['id' => $user->id]) }}">
                                @csrf

                                <div class="row">
                                    <div class="col-md-2 col-sm-2">
                                        <label for="firstname" class="col-form-label">{{ __('Nom') }}</label>
                                    </div>

                                    <div class="col-md-10 col-sm-10">
                                        <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname', $user->firstname) }}" required autocomplete="firstname" autofocus>

                                        @error('firstname')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 col-sm-2">
                                        <label for="lastname" class="col-form-label">{{ __('Cognoms') }}</label>
                                    </div>

                                    <div class="col-md-10 col-sm-10">
                                        <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname', $user->lastname) }}" required autocomplete="lastname" autofocus>

                                        @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 col-sm-2">
                                        <label for="email" class="col-form-label">{{ __('Email') }}</label>
                                    </div>

                                    <div class="col-md-10 col-sm-10">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 col-sm-2">
                                        <label for="password" class="col-form-label">{{ __('Contrasenya') }}</label>
                                    </div>

                                    <div class="col-md-10 col-sm-10">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 col-sm-2">
                                        <label for="password-confirm" class="col-form-label">{{ __('Confirmar Contrasenya') }}</label>
                                    </div>

                                    <div class="col-md-10 col-sm-10">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-light  float-end">
                                    {{ __('Actualitzar') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
@endsection

