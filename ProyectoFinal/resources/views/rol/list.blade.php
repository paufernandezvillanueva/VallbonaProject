@extends('layout')

@section('title', 'Llistat de users')

@section('stylesheets')
@parent
@endsection

@section('content')
    <div class="titulo">
        <h1>Llista de rols</h1>
    </div>


    @if (session('status'))
        <div>
            <strong>Success!</strong> {{ session('status') }}
        </div>
    @endif

    <div class="table-responsive" style=" height: 83vh; width: 60vh; margin: auto ">
        <table class="table table-striped table-dark " style="margin-top: 20px;margin-bottom: 10px; overflow-y:scroll;">
        <thead>
        <tr>
            <th>Name</th>
            <th>Id</th>
            <th><a href="{{ route('rol_new') }}">Nou rol</a></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rols as $rol)
        <tr>
            <td>{{ $rol->name }}</td>
            <td>{{ $rol->id }}</td>
            <td>
                <a href="{{ route('rol_delete', ['id' => $rol->id]) }}">Eliminar</a>
                <a href="{{ route('rol_edit', ['id' => $rol->id]) }}">Editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
        </table>
    </div>
<br>
@endsection
