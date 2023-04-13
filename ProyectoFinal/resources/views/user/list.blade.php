@extends('layout')

@section('title', 'Llistat de users')

@section('stylesheets')
@parent
@endsection

@section('content')
<div class="titulo">
    <h1>Llista d'usuaris</h1>
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
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Cicle ID</th>
            <th>Rol ID</th>
            <th><a href="{{ route('user_new') }}">Nou user</a></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->firstname }}</td>
            <td>{{ $user->lastname }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->cicle_id }}</td>
            <td>{{ $user->rol_id }}</td>
            <td>
                <a href="{{ route('user_delete', ['id' => $user->id]) }}">Eliminar</a>
                <a href="{{ route('user_edit', ['id' => $user->id]) }}">Editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
<br>
@endsection
