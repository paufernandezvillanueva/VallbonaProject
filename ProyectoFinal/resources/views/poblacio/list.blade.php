@extends('layout')

@section('title', 'Llistat de poblacions')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Llistat de poblacions</h1>
    <a href="{{ route('poblacio_new') }}">+ Nou llibre</a>

    @if (session('status'))
        <div>
            <strong>Success!</strong> {{ session('status') }}  
        </div>
    @endif

    <table style="margin-top: 20px;margin-bottom: 10px;">
        <thead>
            <tr>
                <th>Nom</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($poblacions as $poblacio)
                <tr>
                    <td>{{ $poblacio->name }}</td>
                    <td>
                        <a href="{{ route('poblacio_edit', ['id' => $poblacio->id]) }}">Editar</a>
                        <a href="{{ route('poblacio_delete', ['id' => $poblacio->id]) }}" name="{{ $poblacio->name }}" class="delete">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
@endsection