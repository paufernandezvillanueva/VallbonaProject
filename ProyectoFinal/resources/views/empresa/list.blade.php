@extends('layout')

@section('title', 'Llistat d\'empresas')

@section('stylesheets')
@parent
    <link rel="stylesheet" href="{{ asset('css/empresaList.css') }}" />
@endsection

@section('content')
<div class="titulo">
    <h1>Llista d'empreses</h1>
</div>
<!-- <a href="{{ route('empresa_new') }}">+ Nova empresa</a> -->
<table id="empresa-table" class="table table-striped table-dark">
    <thead>
        <tr>
            <th scope="col">CIF</th>
            <th scope="col">Nom</th>
            <th scope="col">Sector</th>
            <th scope="col">Població</th>
            <th scope="col">Estades</th>
            <th scope="col">Valoracio</th>
            <th scope="col">Contactes</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($empresas as $empresa)
        <tr>
            <td><a href="{{ route('empresa_detail', $empresa->id) }}">{{ $empresa->cif }}</a></td>
            <td scope="row"><a href="{{ route('empresa_detail', $empresa->id) }}">{{ $empresa->name }}</a></td>
            <td>
                <form action="{{ route('empresa_list') }}" method="GET">
                    <input type="hidden" name="sector" value="{{ $empresa->sector }}" />
                    <a href="#" onclick="this.parentNode.submit()">{{ $empresa->sector }}</a>
                </form>
            </td>
            <td>
                <form action="{{ route('empresa_list') }}" method="GET">
                    <input type="hidden" name="poblacio" value="{{ $empresa->poblacio_id }}" />
                    <a href="#" onclick="this.parentNode.submit()">{{ $empresa->poblacio->name }}</a>
                </form>
            </td>
            <td><span>{{ $empresa->countEstades() }}</span></td>
            <td><span>{{ $empresa->avgValoracio() }}</span></td>
            <td><span>{{ $empresa->contactes() }}</span></td>
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