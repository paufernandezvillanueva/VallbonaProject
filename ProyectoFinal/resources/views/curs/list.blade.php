@extends('layout')

@section('title', 'Llistat de cursos')

@section('stylesheets')
@parent
@endsection

@section('content')
<div class="titulo">
    <h1>Llista de cursos</h1>
</div>

<div style="margin-bottom:10px"></div>

@if (session('status'))
<div>
    <strong>Success!</strong> {{ session('status') }}
</div>
@endif
<div class="table-responsive" style=" height: 80vh; width: 60vh; margin: auto ">
    <table class="table table-striped table-dark " style="margin-top: 20px;margin-bottom: 10px; -webkit-overflow-scrolling: auto">
    <thead>
        <tr>
            <th scope="col">Nom</th>
            <th><a href="{{ route('curs_new') }}">Nou curs</a></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cursos as $curs)
        <tr>
            <th scope="row">{{ $curs->name }}</th>
            <td>
                <a href="{{ route('curs_delete', ['id' => $curs->id]) }}">Eliminar</a>
                <a href="{{ route('curs_edit', ['id' => $curs->id]) }}">Editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
<br>
@endsection
