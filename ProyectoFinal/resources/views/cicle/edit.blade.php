@extends('layout')

@section('title', 'Editar Cicle')

@section('stylesheets')
@parent
@endsection

@section('content')

    <div class="titulo">
        <h1>Editar cicle</h1>
    </div>
    <a href="{{ route('cicle_list') }}">&laquo; Torna</a>
	<div style="margin-top: 20px">
        <form method="POST" action="{{ route('cicle_edit', ['id' => $cicle->id]) }}">
            @csrf
            <div>
            <label for="shortname">Shortname</label>
            <input type="text" name="shortname" value="{{ $cicle->shortname }}"/>
        </div>
        <div>
            <label for="name">Nom</label>
            <input type="text" name="name" value="{{ $cicle->name }}" />
        </div>
            <button type="submit">Editar Cicle</button>
        </form>
	</div>
@endsection

