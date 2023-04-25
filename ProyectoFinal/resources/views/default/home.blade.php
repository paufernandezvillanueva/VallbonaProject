@extends('layout')

@section('title', 'Home')

@section('stylesheets')
    @parent
@endsection

@section('content')
        <div class="titulo">
            <h1>Llista d'empreses</h1>
        </div>

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
        {{-- @foreach($empresas as $empresa)
            <tr>
                <th scope="row"> {{ $empresa->nom }} </th>
                <td>{{ $empresa->cif }}</td>
                <td>{{ $empresa->sector }}</td>
                <td>{{ $empresa->poblacio }}</td>
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
            </tr>
        @endforeach
        --}}

        <tr>
            <th scope="row">Empresa 1</th>
            <td>100CIF</td>
            <td>Informatica</td>
            <td>Barcelona</td>
            <td>3</td>
            <td>5*</td>
            <td>Fernando: fernando@mail.com___+10</td>
        </tr>
        <tr>
            <th scope="row">Empresa 2</th>
            <td>200CIF</td>
            <td>Informatica</td>
            <td>Granollers</td>
            <td>6</td>
            <td>2.5*</td>
            <td>Rodrigo: rodrigo@mail.com___+3</td>
        </tr>

        </tbody>
    </table>
@endsection
