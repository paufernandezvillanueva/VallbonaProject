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

<div class="modal fade" id="newContacte" tabindex="-1" aria-labelledby="newContacteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="width: 100%; text-align: center;" id="newContacteLabel">Afegir contacte</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('contacte_new') }}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label text-dark" for="name">Name</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="name" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label text-dark" for="empresa_id">Empresa</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-select" name="empresa_id">
                                <option>Selecciona una empresa...</option>
                                @foreach ($empresas as $empresa)
                                <option value="{{ $empresa->id }}">{{ $empresa->name }}</option>
                                @endforeach
                            </select>
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
                            <label class="col-form-label text-dark" for="phonenumber">Telefon</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="phonenumber" />
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

<table id="contacte-table" class="table table-striped table-dark">
    <thead>
        <tr>
            <th>Nom</th=>
            <th>Empresa</th=>
            <th>Correu electrònic</th>
            <th>Telefon</th>
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
                    <input type="hidden" name="empresa" value="{{ $contacte->empresa_id }}" />
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

<div class="modal fade" id="confirmDelete" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">Eliminar contacte</h5>
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
@endsection