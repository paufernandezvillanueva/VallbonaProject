@extends('layout')

@section('title', trans('translation.list_role'))

@section('stylesheets')
@parent
<link rel="stylesheet" href="{{ asset('css/rolList.css') }}" />
@endsection

@section('content')
<div class="titulo">
    <h1>{{ trans('translation.list_role') }}</h1>
</div>

<div id="filter">
    <div id="filter-header">
        <div>
            <button id="import-button" data-bs-toggle="modal" data-bs-target="#importRols">
                <i class="bi bi-cloud-upload-fill"></i>
            </button>
        </div>
        <div>
            <button id="filter-button">
                <i class="bi bi-filter"></i>
            </button>
        </div>
    </div>
    <form id="filter-form" class="filter-form filter-form-closed-base" method="post" style="max-height: 0px;" action="{{ route('rol_list') }}">
        @csrf
        <div class="row d-flex justify-content-center">
            <div class="col-lg-1 col-3">
                <label for="name">{{ trans('translation.name').':' }}</label>
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

<div class="modal fade" id="newRol" tabindex="-1" aria-labelledby="newRolLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRolLabel">{{ trans('translation.create').' '.trans('translation.role') }}</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>
            <form method="POST" name="addRolForm" action="{{ route('rol_new') }}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-2 col-12">
                            <label class="col-form-label" for="name">{{ trans('translation.name') }}</label>
                        </div>
                        <div class="col-md-10 col-12">
                            <input class="form-control" type="text" name="name" />
                        </div>
                        <div class="error" id="name-add-rol-error"></div>
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

<div class="table-responsive">
    <table id="rol-table" class="table table-striped table-dark">
        <thead>
            <tr>
                <th>{{ trans('translation.name') }}</th>
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
                    <a data-id="{{ $rol->id }}" data-name="{{ $rol->name }}" class="iconBasura" data-bs-toggle="modal" data-bs-target="#confirmDelete">
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
                <h5 class="modal-title" id="confirmDeleteLabel">{{ trans('translation.delete').' '.trans('translation.role') }} </h5>
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

                                var dataName = elem.dataset.name;
                                document.getElementById("nombreDelete").innerHTML = dataName;
                            });
                        });
                    </script>
                    @csrf
                    <p>{{ trans('translation.confirm_delete') }} <span id="nombreDelete"></span>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ trans('translation.cancel') }}</button>
                    <button type="submit" class="btn btn-success" id="btnConfirmar">{{ trans('translation.confirm') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="importRols" tabindex="-1" aria-labelledby="importRolsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importRolsLabel">{{ trans('translation.import_csv') }}</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>
            <form id="addForm" name="importRolsForm" action="{{ route('rol_import') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="csv">CSV</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="file" name="csv" id="csv" accept=".csv" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ trans('translation.cancel') }}</button>
                    <button type="submit" class="btn btn-secondary">{{ trans('translation.import') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript" src="{{ asset('js/filter_animation.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/filter_size.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/reiniciar_filtres.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/validators.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/rol_add_validator.js') }}"></script>
@endsection