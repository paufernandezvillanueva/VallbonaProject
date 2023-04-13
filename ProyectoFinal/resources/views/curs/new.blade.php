@extends('layout')

@section('title', 'Nou Curs')

@section('stylesheets')
@parent
@endsection

@section('content')
<h1>Nou Curs</h1>
<a href="{{ route('curs_list') }}">&laquo; Torna</a>
<div style="margin-top: 20px">
    <form method="POST" action="{{ route('curs_new') }}">
        @csrf
        <div>
            <label for="name">Nom</label>
            <input type="text" name="name" />
        </div>
        <button type="submit">Crear Curs</button>
    </form>
</div>
@endsection
