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

    <table style="margin-top: 20px;margin-bottom: 10px;">
        <thead>
            <tr>
                <th>Username</th><th>Email</th><th>Cicle ID</th><th>Rol ID</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->username }}</td><td>{{ $user->email }}</td><td>{{ $user->cicle_id }}</td><td>{{ $user->rol_id }}</td>
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
