@extends('layout')

@section('title', 'Llistat de cicles')

@section('stylesheets')
@parent
@endsection

@section('content')
    <div class="titulo">
        <h1>Llista de cicles</h1>
    </div>
    <a href="{{ route('cicle_new') }}">Nou cicle</a>

    @if (session('status'))
        <div>
            <strong>Success!</strong> {{ session('status') }}
        </div>
    @endif


<table style="margin-top: 20px;margin-bottom: 10px;">
    <thead>
        <tr>
            <th>Shortname</th>
            <th>Name</th>
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
<br>
@endsection
