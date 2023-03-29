@extends('layout')

@section('title', 'Nou User')

@section('stylesheets')
@parent
@endsection

@section('content')
<h1>Nou User</h1>
<a href="{{ route('user_list') }}">&laquo; Torna</a>
<div style="margin-top: 20px">
    <form method="POST" action="{{ route('user_new') }}">
        @csrf
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" />
        </div>
        <div>
            <label for="email">Email</label>
            <input type="text" name="email" />
        </div>
        <div>
            <label for="cicle_id">Cicle_id</label>
            <input type="number" name="cicle_id" />
        </div>
        <div>
            <label for="rol_id">Rol_id</label>
            <input type="number" name="rol_id" />
        </div>
        <button type="submit">Crear User</button>
    </form>
</div>
@endsection