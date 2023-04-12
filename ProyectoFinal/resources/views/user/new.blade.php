@extends('layout')

@section('title', 'Nou User')

@section('stylesheets')
@parent
@endsection

@section('content')
<div class="titulo">
    <h1>Nou usuari</h1>
</div>
<a href="{{ route('user_list') }}">&laquo; Torna</a>
<div style="margin-top: 20px">
    <form method="POST" action="{{ route('user_new') }}">
        @csrf
        <div>
            <label for="firstname">Firstname</label>
            <input type="text" name="firstname" />
        </div>
        <div>
            <label for="lastname">Lastname</label>
            <input type="text" name="lastname" />
        </div>
        <div>
            <label for="email">Email</label>
            <input type="text" name="email" />
        </div>
        <div>
            <label for="cicle_id">Cicle</label>
            <select name="cicle_id">
                @foreach ($cicles as $cicle)
                <option value="{{ $cicle->id }}">{{ $cicle->shortname }} - {{ $cicle->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="rol_id">Rol</label>
            <select name="rol_id">
                @foreach ($rols as $rol)
                <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Crear User</button>
    </form>
</div>
@endsection