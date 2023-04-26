@extends('layout')

@section('title', $cicle->shortname)

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/cicleDetail.css') }}" />
@parent
@endsection

@section('content')
<div class="titulo">
    <h1>{{ $cicle->shortname }} - {{ $cicle->name }}</h1>
</div>
<div class="containerCicle">
    <div>
        <div class="btnTorna">
            <a href="{{ route('cicle_list') }}"><i class="bi bi-arrow-left-circle-fill"></i> Torna</a>
        </div>
        <div class="labels">
            <div class="infoCicle">
                <div class="list-header">
                    <div id="info">Informació</div>
                    <div class="filtro"><button class="filtrar" data-bs-toggle="modal" data-bs-target="#editInfo">Editar</button></div>
                </div>
                <table id="info-table" class="table table-striped table-dark">
                    <tr>
                        <th scope="row">Acrònim</th>
                        <td>{{ $cicle->shortname }}</td>
                    </tr>
                    <tr>
                        <th>Nom</th>
                        <td>{{ $cicle->name }}</td>
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
                <h5 class="modal-title" id="editInfoLabel">Editar cicle</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" name="editCicleForm" action="{{ route('cicle_edit', $cicle->id) }}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="shortname">Acrònim</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="shortname" value="{{ $cicle->shortname }}" />
                        </div>
                        <div class="error" id="shortname-edit-cicle-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="name">Nom</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="name" value="{{ $cicle->name }}" />
                        </div>
                        <div class="error" id="name-edit-cicle-error"></div>
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
<script type="text/javascript" src="{{ asset('js/cicle_edit_validator.js') }}"></script>
@endsection