@extends('layout')

@section('title', 'Llistat d\'empresas')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/estadaDetail.css') }}" />
    @parent
@endsection

@section('content')
<div class="titulo">
    <h1>{{ $estada->student_name }}</h1>
</div>
<div class="containerEmpresa">
    <div>
        <div class="labels">
            <div class="infoContacte">
                <div class="list-header">
                    <div id="info">Info estada</div>
                    <div class="filtro"><button class="filtrar">Editar Informacio</button></div>
                </div>
                <table id="info-table" class="table table-striped table-dark">
                    <tr>
                        <th scope="row">Nom Alumne</th>
                        <td>{{ $estada->student_name }}</td>
                    </tr>
                    <tr>
                        <th>Curs</th>
                        <td>{{ $curs->name }}</td>
                    </tr>
                    <tr>
                        <th>Cicle</th>
                        <td>{{ $cicle->shortname }}</td>
                    </tr>
                    <tr>
                        <th>Tutor</th>
                        <td>{{ $estada->tutor() }}</td>
                    </tr>
                    <tr>
                        <th>Tipus estada</th>
                        <td>
                            @if ($estada->dual == true)
                                Dual
                            @else
                                FTC
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Empresa</th>
                        <td>{{ $empresa->name }}</td>
                    </tr>
                    <tr>
                        <th>Valoració</th>
                        <td>{{ $estada->evaluation }}</td>
                    </tr>
                    <tr>
                        <th>Comentari</th>
                        <td>{{ $estada->comment }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<br>
@endsection