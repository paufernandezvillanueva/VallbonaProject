@extends('layout')

@section('title', $curs->name)

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/cursDetail.css') }}" />
@parent
@endsection

@section('content')
<div class="titulo">
    <h1>{{ $curs->name }}</h1>
</div>
<div class="containerCurs">
    <div>
        <div class="btnTorna">
            <a href="{{ route('curs_list') }}"><i class="bi bi-arrow-left-circle-fill"></i> Torna</a>
        </div>
        <div class="labels">
            <div class="infoCurs">
                <div class="list-header">
                    <div id="info">Informació</div>
                    <div class="filtro"><button class="filtrar" data-bs-toggle="modal" data-bs-target="#editInfo">Editar</button></div>
                </div>
                <table id="info-table" class="table table-striped table-dark">
                    <tr>
                        <th scope="row">Curs</th>
                        <td>{{ $curs->name }}</td>
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
                <h5 class="modal-title" id="editInfoLabel">Editar curs</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>
            <form method="POST" name="editCursForm" action="{{ route('curs_edit', $curs->id) }}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="name">Nom</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="name" value="{{ $curs->name }}" placeholder="Ex: 1995-1996" required/>
                        </div>
                        <div class="error" id="name-edit-curs-error"></div>
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
<script type="text/javascript" src="{{ asset('js/curs_edit_validator.js') }}"></script>
@endsection