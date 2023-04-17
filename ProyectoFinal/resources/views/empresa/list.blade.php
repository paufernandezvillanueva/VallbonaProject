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
            <th scope="col"><a href="">Afegir usuari</a></th>
        </tr>
    </thead>
    <tbody>
        @foreach($empresas as $empresa)
        <tr>
            <td><a href="{{ route('empresa_detail', $empresa->id) }}">{{ $empresa->cif }}</a></td>
            <td><a href="{{ route('empresa_detail', $empresa->id) }}">{{ $empresa->name }}</a></td>
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
            <td>
                <form action="{{ route('empresa_list') }}" method="GET">
                    <input type="hidden" name="minEstadas" value="{{ $empresa->countEstades() }}" />
                    <input type="hidden" name="maxEstadas" value="{{ $empresa->countEstades() }}" />
                    <a href="#" onclick="this.parentNode.submit()">{{ $empresa->countEstades() }}</a>
                </form>
            </td>
            <td>
                @if ($empresa->avgValoracio() != "Ninguna")
                <form action="{{ route('empresa_list') }}" method="GET">
                    <input type="hidden" name="minValoracio" value="{{ $empresa->avgValoracio() }}" />
                    <input type="hidden" name="maxValoracio" value="{{ $empresa->avgValoracio() }}" />
                    <a href="#" onclick="this.parentNode.submit()">{{ $empresa->avgValoracio() }}</a>
                </form>
                @else
                <form action="{{ route('empresa_list') }}" method="GET">
                    <input type="hidden" name="maxValoracio" value="{{ $empresa->avgValoracio() }}" />
                    <a href="#" onclick="this.parentNode.submit()">{{ $empresa->avgValoracio() }}</a>
                </form>
                @endif
            </td>
            <td><a href="{{ route('empresa_detail', $empresa->id) }}">{{ $empresa->contactes() }}</a></td>
            <td>
                <a data-id="{{ $empresa->id }}" class="iconBasura" data-bs-toggle="modal" data-bs-target="#confirmDelete">
                    <i class="bi bi-trash3-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="modal fade" id="confirmDelete" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">Eliminar empresa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="GET">
                <div class="modal-body">
                    <script>
                        document.querySelectorAll('.iconBasura').forEach(elem => {
                            elem.addEventListener('click', () => {
                                var dataId = elem.dataset.id;
                                var form = document.querySelector('#confirmDelete form');
                                form.action = "empresa/delete/" + dataId;
                                console.log(form.action);
                            });
                        });
                    </script>
                    @csrf
                    <p>Estàs segur de voler eliminar aquest usuari?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="btnConfirmar">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection