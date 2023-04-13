@extends('layout')

@section('title', 'Llistat de contactes')

@section('stylesheets')
@parent
@endsection

@section('content')
<div class="titulo">
    <h1>Llista de contactes</h1>
</div>

<div style="margin-bottom:10px"></div>

@if (session('status'))
<div>
    <strong>Success!</strong> {{ session('status') }}
</div>
@endif
<div class="table-responsive" style=" height: 80vh; margin: auto ">
    <table class="table table-striped table-dark " style="margin-top: 20px;margin-bottom: 10px; -webkit-overflow-scrolling: auto">
    <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Empresa ID</th>
            <th scope="col">Email</th>
            <th scope="col">Telefon</th>
            <th><a href="{{ route('contacte_new') }}">Nou contacte</a></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($contactes as $contacte)
        <tr>
            <th scope="row">{{ $contacte->name }}</th>
            <!-- <td>{{ $contacte->empresa->name }}</td> -->
            <td>{{ $contacte->empresa_id }}</td>
            <td>{{ $contacte->email }}</td>
            <td>{{ $contacte->phonenumber }}</td>
            <td>
                <a href="{{ route('contacte_delete', ['id' => $contacte->id]) }}">Eliminar</a>
                <a href="{{ route('contacte_edit', ['id' => $contacte->id]) }}">Editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
<br>
@endsection
