@extends('layout')

@section('title', 'Nou User')

@section('stylesheets')
@parent
@endsection

@section('content')
    <div class="titulo">
        <h1>Nou rol</h1>
    </div>
<a href="{{ route('rol_list') }}">&laquo; Torna</a>
<div style="margin-top: 20px">
    <form method="POST" action="{{ route('rol_new') }}">
        @csrf
        <div>
            <label for="name">Nom</label>
            <input type="text" name="name" />
        </div>
        <button type="submit">Crear Rol</button>
    </form>
</div>
@endsection
