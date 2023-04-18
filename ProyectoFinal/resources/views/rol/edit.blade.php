@extends('layout')

@section('title', 'Editar Rol')

@section('stylesheets')
@parent
@endsection

@section('content')

    <div class="titulo">
        <h1>Editar Rol</h1>
    </div>
    <a href="{{ route('rol_list') }}">&laquo; Torna</a>
	<div style="margin-top: 20px">
        <form method="POST" action="{{ route('rol_edit', ['id' => $rol->id]) }}">
            @csrf
            <div>
            <label for="username">Nom</label>
            <input type="text" name="username" value="{{ $rol->name }}"/>
        </div>

            <button type="submit">Editar Rol</button>
        </form>
	</div>
@endsection

