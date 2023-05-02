@extends('layout')

@section('title', 'Llistat de rols')

@section('stylesheets')
@parent
<link rel="stylesheet" href="{{ asset('css/rolList.css') }}" />
@endsection

@section('content')
<div class="titulo">
    <h1>Llistat de rols</h1>
</div>

<div id="filter">
    <div id="filter-header">
        <div>
            <button id="import-button"><i class="bi bi-cloud-upload-fill"></i></button>
        </div>
        <div>
            <button id="filter-button"><i class="bi bi-filter"></i></button>
        </div>
    </div>
    <form id="filter-form" class="filter-form filter-form-closed-base" method="POST" action="{{ route('rol_list') }}">@csrf
        <div id="filter-form-container">
            <div>
            <label for="name">Nom: 
                @if (isset($request->name) && $request->name != "")
                   <input type="text" id="name" name="name" value="{{ $request->name }}"></input>
                @else
                    <input type="text" id="name" name="name"></input>
                @endif
            </label><br>
            </div>
            <div>
            </div>
        </div>
        <div id="filter-form-button"><input type="submit" class="btn btn-secondary" value="Filtrar"></div>
    </form>
</div>

<div class="modal fade" id="newRol" tabindex="-1" aria-labelledby="newRolLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRolLabel">Afegir rol</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>
            <form method="POST" name="addRolForm" action="{{ route('rol_new') }}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="name">Nom</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="name" required/>
                        </div>
                        <div class="error" id="name-add-rol-error"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-secondary">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<table id="rol-table" class="table table-striped table-dark">
    <thead>
        <tr>
            <th>Nom</th>
            <th>
                <a class="iconAdd" data-bs-toggle="modal" data-bs-target="#newRol">
                    <i class="bi bi-plus-square-fill"></i>
                </a>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rols as $rol)
        <tr>
            <td><a href="{{ route('rol_detail', $rol->id) }}">{{ $rol->name }}</a></td>
            <td>
                <a data-id="{{ $rol->id }}" class="iconBasura" data-bs-toggle="modal" data-bs-target="#confirmDelete">
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
                <h5 class="modal-title" id="confirmDeleteLabel">Eliminar Rol</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>
            <form method="GET">
                <div class="modal-body">
                    <script>
                        document.querySelectorAll('.iconBasura').forEach(elem => {
                            elem.addEventListener('click', () => {
                                var dataId = elem.dataset.id;
                                var form = document.querySelector('#confirmDelete form');
                                form.action = "delete/" + dataId;
                            });
                        });
                    </script>
                    @csrf
                    <p>Estàs segur de voler eliminar aquest rol?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="btnConfirmar">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/filter_animation.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/validators.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/rol_add_validator.js') }}"></script>
@endsection

