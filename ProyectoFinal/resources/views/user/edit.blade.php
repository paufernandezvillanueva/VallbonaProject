@extends('layout')

@section('title', 'Editar User')

@section('stylesheets')
@parent
@endsection

@section('content')

<div class="titulo">
    <h1>Editar usuari</h1>
</div>
<a href="{{ route('user_list') }}">&laquo; Torna</a>
<div style="margin-top: 20px">
    <form method="POST" action="{{ route('user_edit', ['id' => $user->id]) }}">
        @csrf
        <div>
            <label for="firstname">Nom</label>
            <input type="text" name="firstname" value="{{ $user->firstname }}" />
        </div>
        <div>
            <label for="lastname">Cognom</label>
            <input type="text" name="lastname" value="{{ $user->lastname }}" />
        </div>
        <div>
            <label for="email">Email</label>
            <input type="text" name="email" value="{{ $user->email }}" />
        </div>
        <div>
            <label for="cicle_id">Cicle</label>
            <select name="cicle_id">
                @foreach ($cicles as $cicle)
                <option value="{{ $cicle->id }}" @selected($cicle->id == $user->cicle_id)>{{ $cicle->shortname }} - {{ $cicle->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="rol_id">Rol</label>
            <select name="rol_id">
                @foreach ($rols as $rol)
                <option value="{{ $rol->id }}" @selected($rol->id == $user->rol_id)>{{ $rol->name }}</option>
                @endforeach
            </select>
        </div>
            <button type="submit">Editar usuari</button>
        </form>
	</div>
@endsection

