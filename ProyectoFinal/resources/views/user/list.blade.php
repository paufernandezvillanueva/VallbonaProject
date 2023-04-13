<style>
    .modal-body>.row {
        margin-top: 5px;
        margin-left: 10px;
    }

    label {
        color: black;
    }

    @media screen and (max-width: 575px) {
        label {
            float: left;
        }
    }

    @media screen and (min-width: 576px) {
        label {
            float: right;
        }
    }
</style>
@extends('layout')

@section('title', 'Llistat de users')

@section('stylesheets')
@parent
@endsection

@section('content')
<div class="titulo">
    <h1>Llista d'usuaris</h1>
</div>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nouUsuari">
    Abrir modal
</button>

<div class="modal fade" id="nouUsuari" tabindex="-1" aria-labelledby="nouUsuariLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nouUsuariLabel">Título del modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('user_new') }}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="firstname">Firstname</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="firstname" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="lastname">Lastname</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="lastname" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="email">Email</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="email" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="cicle_id">Cicle</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-select" name="cicle_id">
                                @foreach ($cicles as $cicle)
                                <option value="{{ $cicle->id }}">{{ $cicle->shortname }} - {{ $cicle->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="rol_id">Rol</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-select" name="rol_id">
                                @foreach ($rols as $rol)
                                <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear User</button>
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

<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Email</th>
            <th scope="col">Cicle</th>
            <th scope="col">Rol</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <th scope="row">{{ $user->nomCognoms() }}</th>
            <td>{{ $user->email }}</td>
            <td>{{ $user->cicle->shortname }}</td>
            <td>{{ $user->rol->name }}</td>
            <td>
                <a href="{{ route('user_delete', ['id' => $user->id]) }}">Eliminar</a>
            </td>
            <td>
                <a href="{{ route('user_edit', ['id' => $user->id]) }}">Editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<br>
@endsection