@extends('layout')

@section('title', 'Llistat d\'empresas')

@section('stylesheets')
@parent
@endsection

@section('content')
<div class="titulo">
    <h1>Llista d'empreses</h1>
</div>
<!-- <a href="{{ route('empresa_new') }}">+ Nova empresa</a> -->
<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">CIF</th>
            <th scope="col">Sector</th>
            <th scope="col">Població</th>
            <th scope="col">Estades</th>
            <th scope="col">Valoracio</th>
            <th scope="col">Contactes</th>
        </tr>
    </thead>
    <tbody>
        @foreach($empresas as $empresa)
        <tr>
            <th scope="row"> {{ $empresa->name }} </th>
            <td>{{ $empresa->cif }}</td>
            <td>{{ $empresa->sector }}</td>
            <td>{{ $empresa->poblacio_id }}</td>
            {{--
            <td>{{ $empresa->count->estades }}</td>
            <td>{{ $empresa->avgValoracio }}</td>
            @foreach($contactes as $contacte)
            <table>
                <tr>
                    <td> {{ $contacte->nom }}</td>
                    <td> {{ $contacte->telefon }}</td>
                    <td> {{ $contacte->mail }}</td>
                </tr>
            </table>
            @endforeach
            --}}
            <td></td>
            <td></td>
            <td></td>
            <td>
                <a href="{{ route('empresa_edit', ['id' => $empresa->id]) }}">Editar</a>
            </td>
            <td>
                <a href="{{ route('empresa_delete', ['id' => $empresa->id]) }}">Eliminar</a>
            </td>
        </tr>
        @endforeach

        <!-- @foreach ($empresas as $empresa)
        <tr>
            <td>{{ $empresa->cif }}</td>
            <td>{{ $empresa->name }}</td>
            <td>{{ $empresa->sector }}</td>
            <td>{{ $empresa->comarca_id }}</td>
            <td>{{ $empresa->poblacio_id }}</td>
            <td>
                <a href="{{ route('empresa_delete', ['id' => $empresa->id]) }}">Eliminar</a>
            </td>
            <td>
                <a href="{{ route('empresa_edit', ['id' => $empresa->id]) }}">Editar</a>
            </td>
        </tr>
        @endforeach -->
    </tbody>
</table>

<br>
@endsection