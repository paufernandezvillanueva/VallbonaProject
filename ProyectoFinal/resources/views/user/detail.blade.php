@extends('layout')

@section('title', $user->name)

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/usuariDetail.css') }}" />
@parent
@endsection

@section('content')
<div class="titulo">
    <h1>{{ $user->name }}</h1>
</div>
<div class="containerUsuari">
    <div>
        <div class="btnTorna">
            <a href="{{ route('user_list') }}"><i class="bi bi-arrow-left-circle-fill"></i> Torna</a>
        </div>
        <div class="labels">
            <div class="infoUsuari">
                <div class="list-header">
                    <div id="info">Informació</div>
                    <div class="filtro"><button class="filtrar" data-bs-toggle="modal" data-bs-target="#editInfo">Editar</button></div>
                </div>
                <table id="info-table" class="table table-striped table-dark">
                    <tr>
                        <th scope="row">Nom</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Cicle</th>
                        <td>{{ $user->cicle->shortname }} - {{ $user->cicle->name }}</td>
                    </tr>
                    <tr>
                        <th>Rol</th>
                        <td>{{ $user->rol->name }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editInfo" tabindex="-1" aria-labelledby="editInfoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editInfoLabel">Editar usuari</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>
            <form method="POST" name="editUserForm" action="{{ route('user_edit', $user->id) }}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="name">Nom</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="name" value="{{ $user->name }}" />
                        </div>
                        <div class="error" id="firstname-edit-user-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="email">Email</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="email" value="{{ $user->email }}" />
                        </div>
                        <div class="error" id="email-edit-user-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="cicle_id">Cicle</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-select" name="cicle_id" value="{{ $user->cicle->id }}">
                                @foreach($cicles as $cicle)
                                    @if ($cicle->id == $user->cicle_id)
                                        <option value="{{ $cicle->id }}" selected>{{ $cicle->shortname }} - {{ $cicle->name }}</option>
                                    @else
                                        <option value="{{ $cicle->id }}">{{ $cicle->shortname }} - {{ $cicle->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="error" id="cicle_id-edit-user-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="rol_id">Rol</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-select" name="rol_id" value="{{ $user->rol->id }}">
                                @foreach($rols as $rol)
                                    @if ($rol->id == $user->rol_id)
                                        <option value="{{ $rol->id }}" selected>{{ $rol->name }}</option>
                                    @else
                                        <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="error" id="rol_id-edit-user-error"></div>
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
<script type="text/javascript" src="{{ asset('js/validators.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/user_edit_validator.js') }}"></script>
<br>
@endsection