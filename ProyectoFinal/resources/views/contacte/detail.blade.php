@extends('layout')

@section('title', 'Llistat d\'empresas')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/contacteDetail.css') }}" />
    @parent
@endsection

@section('content')
<div class="titulo">
    <h1>{{ $contacte->name }}</h1>
</div>
<div class="containerEmpresa">
    <div>
        <div class="labels">
            <div class="infoContacte">
                <div class="list-header">
                    <div id="info">Info contacte</div>
                    <div class="filtro"><button class="filtrar">Editar Informacio</button></div>
                </div>
                <table id="info-table" class="table table-striped table-dark">
                    <tr>
                        <th scope="row">Nom contacte</th>
                        <td>{{ $contacte->name }}</td>
                    </tr>
                    <tr>
                        <th>Empresa</th>
                        <td>{{ $empresa->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $contacte->email }}</td>
                    </tr>
                    <tr>
                        <th>Telefon</th>
                        <td>{{ $contacte->phonenumber }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<br>
@endsection