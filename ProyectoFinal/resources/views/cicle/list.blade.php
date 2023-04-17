@extends('layout')

@section('title', 'Llistat de cicles')

@section('stylesheets')
@parent
@endsection

@section('content')
    <div class="titulo">
        <h1>Llista de cicles</h1>
    </div>

    @if (session('status'))
        <div>
            <strong>Success!</strong> {{ session('status') }}
        </div>
    @endif


    <div class="table-responsive" style=" height: 80vh; margin: auto ">
        <table class="table table-striped table-dark " style="margin-top: 20px;margin-bottom: 10px; -webkit-overflow-scrolling: auto">
    <thead>
        <tr>
            <th>Shortname</th>
            <th>Name</th>
            <th>
                <a href="{{ route('cicle_new') }}">Nou cicle</a>
            </tr>
    </thead>
    <tbody>
        @foreach ($cicles as $cicle)
        <tr>
            <td>{{ $cicle->shortname }}</td>
            <td>{{ $cicle->name }}</td>
            <td>
                <a href="{{ route('cicle_delete', ['id' => $cicle->id]) }}">Eliminar</a>
                <a href="{{ route('cicle_edit', ['id' => $cicle->id]) }}">Editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
        </table>
    </div>
<br>
@endsection
