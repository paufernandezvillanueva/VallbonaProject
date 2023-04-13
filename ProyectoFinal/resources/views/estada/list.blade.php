@extends('layout')

@section('title', 'Llistat de estadas')

@section('stylesheets')
@parent
@endsection

@section('content')
    <div class="titulo">
        <h1>Llistat de estadas</h1>
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
            <th>Nom Estudiant</th>
            <th>Cicle ID</th>
            <th>Empresa ID</th>
            <th>Evaluation</th>
            <th>Comentaris</th>
            <th>Dual?</th>
            <th>Registrado por</th>
            <th>Curs ID</th>
            <th> <a href="{{ route('estada_new') }}">Nova estada</a></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($estadas as $estada)
        <tr>
            <td>{{ $estada->student_name }}</td>
            <td>{{ $estada->cicle_id }}</td>
            <td>{{ $estada->empresa_id }}</td>
            <td>{{ $estada->evaluation }}</td>
            <td>{{ $estada->comment }}</td>
            <td>{{ $estada->dual }}</td>
            <td>{{ $estada->registered_by }}</td>
            <td>{{ $estada->curs_id }}</td>
            <td>
                <a href="{{ route('estada_delete', ['id' => $estada->id]) }}">Eliminar</a>
                <a href="{{ route('estada_edit', ['id' => $estada->id]) }}">Editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

    </div>
    <br>
@endsection
