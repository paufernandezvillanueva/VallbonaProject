@extends('layout')

@section('title', 'Llistat de contactes')

@section('stylesheets')
@parent
@endsection

@section('content')
<div class="titulo">
    <h1>Llista de contactes</h1>
</div>
<a href="{{ route('contacte_new') }}">+ Nou contacte</a>
<div style="margin-bottom:10px"></div>

@if (session('status'))
<div>
    <strong>Success!</strong> {{ session('status') }}
</div>
@endif

<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Empresa ID</th>
            <th scope="col">Email</th>
            <th scope="col">Telefon</th>
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
            </td>
            <td>
                <a href="{{ route('contacte_edit', ['id' => $contacte->id]) }}">Editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<br>
@endsection