@extends('layout')

@section('title', Auth::user()->name)

@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
    <div class="titulo">
        <h1>{{ Auth::user()->name }}</h1>
    </div>
            <div class="row justify-content-center">
                <div class="col-md-8" style="width: 95%">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('user_update',['id' => $user->id]) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <label for="name" class="col-form-label">{{ trans('translation.name').':' }}</label>
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>

                                        @error('firstname')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <label for="email" class="col-form-label">{{ trans('translation.email').':' }}</label>
                                    </div>

                                    <div class="col-md-9 col-sm-9">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <label for="password" class="col-form-label">{{ trans('translation.password').':' }}</label>
                                    </div>

                                    <div class="col-md-9 col-sm-9">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <label for="password-confirm" class="col-form-label">{{ trans('translation.confirm_password').':' }}</label>
                                    </div>

                                    <div class="col-md-9 col-sm-9">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="row">
                                    <div id="gmail" class="col-form-label">
                                        {{ trans('translation.link_gmail').':' }}
                                        @if (Auth::user()->google_id == null)
                                            <i class="bi bi-x-lg text-danger ms-1"></i>
                                        @else
                                            <i class="bi bi-check-lg text-success ms-1"></i>
                                        @endif
                                    </div>
                                </div>

                                <div id="card-form-button">
                                    <button type="submit" class="btn btn-secondary">
                                        {{ trans('translation.update') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
@endsection

