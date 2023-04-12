@extends('layout')

@section('title', 'Llistat de users')

@section('stylesheets')
@parent
@endsection

@section('content')
<div class="titulo">
    <h1>Llista d'usuaris</h1>
</div>
<a href="{{ route('user_new') }}">+ Nou user</a>

@if (session('status'))
<div>
    <strong>Success!</strong> {{ session('status') }}
</div>
@endif

<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Email</th>
            <th scope="col">Cicle</th>
            <th scope="col">Rol</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <th scope="row">{{ $user->nomCognoms() }}</th>
            <td>{{ $user->email }}</td>
            <td>{{ $user->cicle->shortname }}</td>
            <td>{{ $user->rol->name }}</td>
            <td>
                <a href="{{ route('user_delete', ['id' => $user->id]) }}">Eliminar</a>
            </td>
            <td>
                <a href="{{ route('user_edit', ['id' => $user->id]) }}">Editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<br>
@endsection