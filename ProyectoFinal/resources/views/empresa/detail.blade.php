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
<div class="containerEmpresa">
    <div>
        <div class="labels">
            <div class="infoEmpresa">
                <div id="info">
                    Info empresa
                </div>
                <div class="filtro">
                    
                    <button class="filtrar">Editar Informacio</button>
                </div>
                <table class="table table-striped table-dark">
                    <tr>
                        <th scope="row">CIF</th>
                        <td>{{ $empresa->cif }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Nom empresa</th>
                        <td>{{ $empresa->name }}</td>
                    </tr>
                    <tr>
                        <th>Sector</th>
                        <td>{{ $empresa->sector }}</td>
                    </tr>
                    <tr>
                        <th>Comarca</th>
                        <td>{{ $poblacio->comarca->name }}</td>
                    </tr>
                    <tr>
                        <th>Poblacio</th>
                        <td>{{ $poblacio->name }}</td>
                    </tr>
                </table>
            </div>
            <div class="contactes">
                <div id="contactes">Contactes</div>
                <div class="filtro">
                    <button class="filtrar">Crear Contacte</button>
                </div>
                <table id="contactes-table" class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Correu Electronic</th>
                            <th scope="col">Telefon</th>
                        </tr>
                    </thead>
                    <tbody id="contactes-info">
                    @foreach($contactes as $contacte)
                        <tr>
                            <th scope="row">{{ $contacte->name }}</th>
                            <td>{{ $contacte->email }}</td>
                            <td>{{ $contacte->phonenumber }}</td>
                        </tr> 
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        <div class="estades">
            <div id="estades">Estades</div>
            <div class="filtro">
                <button class="filtrar">Crear Estada</button>
            </div>
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">Empresa</th>
                        <th scope="col">Alumne</th>
                        <th scope="col">Cicle</th>
                        <th scope="col">Valoracio</th>
                        <th scope="col">Tipus estada</th>
                        <th scope="col">Tutor</th>
                        <th scope="col">Comentaris</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Empresa 1</th>
                        <td>Pedro Perez</td>
                        <td>DAW</td>
                        <td>4*</td>
                        <td>FCT</td>
                        <td>Fernando</td>
                        <td>Solo presencial</td>
                    </tr>                        
                    <tr>
                        <th scope="row">Empresa 1</th>
                        <td>Juan Perez</td>
                        <td>DAW</td>
                        <td>5*</td>
                        <td>DUAL</td>
                        <td>Fernando</td>
                        <td>Solo presencial</td>
                    </tr>
                    <tr>
                        <th scope="row">Empresa 1</th>
                        <td>Roberto Perez</td>
                        <td>DAM</td>
                        <td>4,3*</td>
                        <td>FCT</td>
                        <td>Fernando</td>
                        <td>Solo presencial</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<br>
@endsection