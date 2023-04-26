@extends('layout')

@section('title', 'Llistat de contactes')

@section('stylesheets')
@parent
<link rel="stylesheet" href="{{ asset('css/contacteList.css') }}" />
@endsection

@section('content')
<div class="titulo">
    <h1>Llistat de contactes</h1>
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
    <form id="filter-form" class="filter-form filter-form-closed-base" action="{{ route('contacte_list') }}">
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
            <label for="empresa">Empresa:
                @if (isset($request->empresa) && $request->empresa != "")
                   <input type="text" id="empresa" name="empresa" value="{{ $request->empresa }}"></input>
                @else
                    <input type="text" id="empresa" name="empresa"></input>
                @endif
            </label><br>
            </div>
        </div>
        <div id="filter-form-button"><input type="submit" value="Filtrar"></div>
    </form>
</div>

<table id="contacte-table" class="table table-striped table-dark">
    <thead>
        <tr>
            <th>Nom i cognoms</th>
            <th>Empresa</th>
            <th>Correu electrònic</th>
            <th>Telèfon</th>
            <th>
                <a class="iconAdd" data-bs-toggle="modal" data-bs-target="#newContacte">
                    <i class="bi bi-plus-square-fill"></i>
                </a>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($contactes as $contacte)
        <tr>
            <td><a href="{{ route('contacte_detail', $contacte->id) }}">{{ $contacte->name }}</a></td>
            <td>
                <form action="{{ route('contacte_list') }}" method="GET">
                    <input type="hidden" name="empresa" value="{{ $contacte->empresa->name }}" />
                    <a href="#" onclick="this.parentNode.submit()">{{ $contacte->empresa->name }}</a>
                </form>
            </td>
            <td><a href="{{ route('contacte_detail', $contacte->id) }}">{{ $contacte->email }}</a></td>
            <td><a href="{{ route('contacte_detail', $contacte->id) }}">{{ $contacte->phonenumber }}</a></td>
            <td>
                <a data-id="{{ $contacte->id }}" class="iconBasura" data-bs-toggle="modal" data-bs-target="#confirmDelete">
                    <i class="bi bi-trash3-fill"></i>
                </a>
                <!-- <a href="{{ route('contacte_edit', ['id' => $contacte->id]) }}">Editar</a> -->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="modal fade" id="newContacte" tabindex="-1" aria-labelledby="newContacteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newContacteLabel">Afegir contacte</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" name="addContacteForm" action="{{ route('contacte_new') }}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="name">Nom i cognoms</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="name" required/>
                        </div>
                        <div class="error" id="name-add-contacte-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="empresa_id">Empresa</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-select" name="empresa_id">
                                <option value="default">Selecciona una empresa...</option>
                                @foreach ($empresas as $empresa)
                                <option value="{{ $empresa->id }}">{{ $empresa->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="error" id="empresa_id-add-contacte-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="email">Correu electrònic</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="email" required/>
                        </div>
                        <div id="email-add-contacte-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="phonenumber">Telèfon</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="phonenumber" required/>
                        </div>
                        <div class="error" id="phonenumber-add-contacte-error"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if (session('status'))
<div>
    <strong>Success!</strong> {{ session('status') }}
</div>
@endif

<div class="modal fade" id="confirmDelete" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">Eliminar contacte</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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
                    <p>Estàs segur de voler eliminar aquest contacte?</p>
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
<script type="text/javascript" src="{{ asset('js/contacte_add_validator.js') }}"></script>
@endsection

