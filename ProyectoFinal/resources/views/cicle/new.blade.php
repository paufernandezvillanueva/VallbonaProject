@extends('layout')

@section('title', 'Nou User')

@section('stylesheets')
@parent
@endsection

@section('content')
    <div class="titulo">
        <h1>Nou cicle</h1>
    </div>
<a href="{{ route('cicle_list') }}">&laquo; Torna</a>
<div style="margin-top: 20px">
    <form method="POST" action="{{ route('cicle_new') }}">
        @csrf
        <div>
            <label for="shorname">Shortname</label>
            <input type="text" name="shortname" />
        </div>
        <div>
            <label for="name">Lastname</label>
            <input type="text" name="name" />
        </div>
        <button type="submit">Crear cicle</button>
    </form>
</div>
@endsection
