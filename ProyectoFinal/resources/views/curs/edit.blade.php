@extends('layout')

@section('title', 'Editar Curs')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Editar Curs</h1>
<a href="{{ route('curs_list') }}">&laquo; Torna</a>
<div style="margin-top: 20px">
<form method="POST" action="{{ route('curs_edit', ['id' => $curs->id]) }}">
        @csrf
        <div>
            <label for="name">Nom</label>
            <input type="text" name="name" value="{{ $curs->name }}"/>
        </div>

        <button type="submit">Editar Curs</button>
    </form>
</div>
@endsection
