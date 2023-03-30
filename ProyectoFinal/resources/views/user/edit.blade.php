@extends('layout')

@section('title', 'Editar Llibre')

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
            <label for="username">Username</label>
            <input type="text" name="username" value="{{ $user->username }}"/>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="text" name="email" value="{{ $user->email }}"/>
        </div>
        <div>
            <label for="cicle_id">Cicle_id</label>
            <input type="number" name="cicle_id" value="{{ $user->cicle_id }}"/>
        </div>
        <div>
            <label for="rol_id">Rol_id</label>
            <input type="number" name="rol_id" value="{{ $user->rol_id }}"/>
        </div>
            <button type="submit">Editar Llibre</button>
        </form>
	</div>
@endsection
