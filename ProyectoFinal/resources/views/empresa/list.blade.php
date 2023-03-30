@extends('layout')

@section('title', 'Llistat d\'empresas')

@section('stylesheets')
@parent
@endsection

@section('content')
<h1>Llistat d'empresas</h1>
<a href="{{ route('empresa_new') }}">+ Nova empresa</a>

@if (session('status'))
<div>
    <strong>Success!</strong> {{ session('status') }}
</div>
@endif

<table style="margin-top: 20px;margin-bottom: 10px;">
    <thead>
        <tr>
            <th>CIF</th>
            <th>Nom</th>
            <th>Sector</th>
            <!-- <th>Comarca</th> -->
            <th>Població</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($empresas as $empresa)
        <tr>
            <td>{{ $empresa->cif }}</td>
            <td>{{ $empresa->name }}</td>
            <td>{{ $empresa->sector }}</td>
            <!-- <td>{{ $empresa->comarca_id }}</td> -->
            <td>{{ $empresa->poblacio_id }}</td>
            <td>
                <a href="{{ route('empresa_delete', ['id' => $empresa->id]) }}">Eliminar</a>
            </td>
            <td>
                <a href="{{ route('empresa_edit', ['id' => $empresa->id]) }}">Editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<br>
@endsection