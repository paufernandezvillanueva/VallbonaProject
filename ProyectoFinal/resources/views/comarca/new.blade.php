@extends('layout')

@section('title', 'Nova Comarca')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="titulo">
        <h1>Nova Comarca</h1>
    </div>

    <a href="{{ route('comarca_list') }}">&laquo; Torna</a>
	<div style="margin-top: 20px">
        <form method="POST" name="form" action="{{ route('comarca_new') }}">
            @csrf
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" />
            </div>
            <button type="submit" name="submit">Crear Comarca</button>
        </form>
	</div>
@endsection
