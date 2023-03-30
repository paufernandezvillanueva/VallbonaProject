@extends('layout')

@section('title', 'Editar Poblacio')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Editar Poblacio</h1>
    <a href="{{ route('poblacio_list') }}">&laquo; Torna</a>
	<div style="margin-top: 20px">
        <form method="POST" action="{{ route('poblacio_edit', ['id' => $poblacio->id]) }}">
            @csrf
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ $poblacio->name }}" />
            </div>
            <button type="submit">Desar</button>
        </form>
	</div>
@endsection