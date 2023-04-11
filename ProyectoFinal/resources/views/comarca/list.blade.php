@extends('layout')

@section('title', 'Llistat de comarcas')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="titulo">
        <h1>Llistat de comarcas</h1>
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
                    <th>Nom</th>
                    <th><a href="{{ route('comarca_new') }}">Nova comarca</a></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($comarcas as $comarca)
                    <tr>
                        <td>{{ $comarca->name }}</td>
                        <td>
                            <a href="{{ route('comarca_edit', ['id' => $comarca->id]) }}">Editar</a>
                            <a href="{{ route('comarca_delete', ['id' => $comarca->id]) }}" name="{{ $comarca->name }}" class="delete">Eliminar</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    <br>
@endsection
