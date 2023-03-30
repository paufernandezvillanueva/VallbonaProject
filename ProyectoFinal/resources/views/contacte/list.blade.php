@extends('layout')

@section('title', 'Llistat de contactes')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Llistat de contactes</h1>
    <a href="{{ route('contacte_new') }}">+ Nou contacte</a>

    @if (session('status'))
        <div>
            <strong>Success!</strong> {{ session('status') }}  
        </div>
    @endif

    <table style="margin-top: 20px;margin-bottom: 10px;">
        <thead>
            <tr>
                <th>Nom</th><th>Empresa</th><th>Email</th><th>Telefon</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contactes as $contacte)
                <tr>
                    <td>{{ $contacte->name }}</td>
                    <td>{{ $contacte->empresa->name }}</td>
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