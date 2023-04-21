@extends('layout')

@section('title', 'Llistat d\'usuaris')

@section('stylesheets')
@parent
<link rel="stylesheet" href="{{ asset('css/usuariList.css') }}" />
@endsection

@section('content')
<div class="titulo">
    <h1>Llistat d'usuaris</h1>
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
    <form id="filter-form" class="filter-form filter-form-closed-base" action="{{ route('user_list') }}">
        <div id="filter-form-container">
            <div>
                <label>Nom estudiant: 
                    @if (isset($request->name) && $request->name != "")
                    <input type="text" id="name" name="name" value="{{ $request->name }}"></input>
                    @else
                    <input type="text" id="name" name="name"></input>
                    @endif
                </label><br>
                <label for="rol">Rol: 
                    @if (isset($request->rol) && $request->rol != "")
                    <select id="rol" name="rol" value="{{ $request->rol }}">
                        <option value="">Selecciona un rol...</option>
                        @foreach ($rols as $rol)
                            @if ($request->rol == $rol->id)
                                <option value="{{ $rol->id }}" selected>{{ $rol->name }}</option>
                            @else
                                <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @else
                    <select id="rol" name="rol">
                        <option value="">Selecciona un rol...</option>
                        @foreach ($rols as $rol)
                            <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                        @endforeach
                    </select>
                    @endif
                </label><br>
            </div>
            <div>
                <label for="cicle">Cicle: 
                    @if (isset($request->cicle) && $request->cicle != "")
                    <select id="cicle" name="cicle" value="{{ $request->cicle }}">
                        <option value="">Selecciona un cicle...</option>
                        @foreach($cicles as $cicle)
                            @if ($request->cicle == $cicle->id)
                                <option value="{{ $cicle->id }}" selected>{{ $cicle->shortname }} - {{ $cicle->name }}</option>
                            @else
                                <option value="{{ $cicle->id }}">{{ $cicle->shortname }} - {{ $cicle->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @else
                    <select id="cicle" name="cicle">
                        <option value="">Selecciona un cicle...</option>
                        @foreach($cicles as $cicle)
                            <option value="{{ $cicle->id }}">{{ $cicle->shortname }} - {{ $cicle->name }}</option>
                        @endforeach
                    </select>
                    @endif
                </label><br>
            </div>
        </div>
        <div id="filter-form-button"><input type="submit" value="Filtrar"></div>
    </form>
</div>

<div class="modal fade" id="newUsuari" tabindex="-1" aria-labelledby="newUsuariLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newUsuariLabel">Afegir usuari</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('user_new') }}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label text-dark" for="firstname">Firstname</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="firstname" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label text-dark" for="lastname">Lastname</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="lastname" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label text-dark" for="email">Correu electrònic</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="email" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label text-dark" for="cicle_id">Cicle</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-select" name="cicle_id">
                                <option>Selecciona un cicle...</option>
                                @foreach ($cicles as $cicle)
                                <option value="{{ $cicle->id }}">{{ $cicle->shortname }} - {{ $cicle->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label text-dark" for="rol_id">Rol</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-select" name="rol_id">
                                <option>Selecciona un rol...</option>
                                @foreach ($rols as $rol)
                                <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancelar</button>
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

<table id="usuari-table" class="table table-striped table-dark">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Correu electrònic</th>
            <th>Cicle</th>
            <th>Rol</th>
            <th>
                <a class="iconAdd" data-bs-toggle="modal" data-bs-target="#newUsuari">
                    <i class="bi bi-plus-square-fill"></i>
                </a>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td><a>{{ $user->nomCognoms() }}</a></td>
            <td><a>{{ $user->email }}</a></td>
            <td><a>{{ $user->cicle->shortname }}</a></td>
            <td><a>{{ $user->rol->name }}</a></td>
            <td>
                <a data-id="{{ $user->id }}" class="iconBasura" data-bs-toggle="modal" data-bs-target="#confirmDelete">
                    <i class="bi bi-trash3-fill"></i>
                </a>
                <!-- <a href="{{ route('user_edit', ['id' => $user->id]) }}">Editar</a> -->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="modal fade" id="confirmDelete" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">Eliminar usuari</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
<script type="text/javascript" src="{{ asset('js/filter_animation.js') }}"></script>
@endsection