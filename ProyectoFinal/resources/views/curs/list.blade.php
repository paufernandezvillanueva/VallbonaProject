@extends('layout')

@section('title', 'Llistat de cursos')

@section('stylesheets')
@parent
<link rel="stylesheet" href="{{ asset('css/cursList.css') }}" />
@endsection

@section('content')
<div class="titulo">
    <h1>{{ trans('translation.list_curs') }}</h1>
</div>

<div class="modal fade" id="newCurs" tabindex="-1" aria-labelledby="newCursLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="width: 100%; text-align: center;" id="newCursLabel">{{ trans('translation.create').' '. trans('translation.course')  }}</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>
            <form method="POST" name="addCursForm" action="{{ route('curs_new') }}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="name">{{ trans('translation.name') }}</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="name" placeholder="Ex: 1995-1996"  />
                        </div>
                        <div class="error" id="name-add-curs-error"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ trans('translation.cancel') }}</button>
                    <button type="submit" class="btn btn-secondary">{{ trans('translation.confirm') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="filter">
    <div id="filter-header">
        <div>
            <button id="import-button" data-bs-toggle="modal" data-bs-target="#importCursos">
                <i class="bi bi-cloud-upload-fill"></i>
            </button>
        </div>
        <div>
            <button id="filter-button">
                <i class="bi bi-filter"></i>
            </button>
        </div>
    </div>
    <form id="filter-form" class="filter-form filter-form-closed-base" method="POST" action="{{ route('curs_list') }}">
        @csrf
        <div class="row d-flex justify-content-center">
            <div class="col-lg-1 col-3">
                <label for="name">{{ trans('translation.name') }}:</label>
            </div>
            <div class="col-lg-4 col-9">
                @if (isset($request->name) && $request->name != "")
                <input class="form-control" type="text" id="name" name="name" value="{{ $request->name }}" />
                @else
                <input class="form-control" type="text" id="name" name="name" />
                @endif
            </div>
            <div class="col-lg-1 col-3">
            </div>
            <div class="col-lg-4 col-9">
            </div>
        </div>
        <div id="filter-form-button">
            <input class="btn btn-danger" type="button" onclick="reiniciarFiltres()" value="{{ trans('translation.reset') }}" />
            <input class="btn btn-secondary" type="submit" id="btnFiltrar" value="{{ trans('translation.filter') }}" />
        </div>
    </form>
</div>

<div class="table-responsive">
    <table id="curs-table" class="table table-striped table-dark">
        <thead>
            <tr>
                <th>{{ trans('translation.name') }}</th>
                <th>
                    <a class="iconAdd" data-bs-toggle="modal" data-bs-target="#newCurs">
                        <i class="bi bi-plus-square-fill"></i>
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cursos as $curs)
            <tr>
                <td><a href="{{ route('curs_detail', $curs->id) }}">{{ $curs->name }}</a></td>
                <td>
                    <a data-id="{{ $curs->id }}" class="iconBasura" data-bs-toggle="modal" data-bs-target="#confirmDelete">
                        <i class="bi bi-trash3-fill"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="confirmDelete" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">{{ trans('translation.delete').' '.trans('translation.course') }}</h5>
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
                    <p>{{ trans('translation.confirm_delete') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ trans('translation.cancel') }}</button>
                    <button type="submit" class="btn btn-success" id="btnConfirmar">{{ trans('translation.confirm') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="importCursos" tabindex="-1" aria-labelledby="importCursosLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importCursosLabel">Importar CSV</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <form id="addForm" name="importCursosForm" action="{{ route('curs_import') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                @csrf
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="csv">CSV</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="file" name="csv" id="csv" accept=".csv"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ trans('translation.cancel') }}</button>
                    <button type="submit" class="btn btn-secondary">Importar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ asset('js/filter_animation.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/reiniciar_filtres.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/validators.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/curs_add_validator.js') }}"></script>
@endsection
