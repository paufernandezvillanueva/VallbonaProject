@extends('layout')

@section('title', trans('translation.list_user'))

@section('stylesheets')
@parent
<link rel="stylesheet" href="{{ asset('css/usuariList.css') }}" />
@endsection

@section('content')
<div class="titulo">
    <h1>{{ trans('translation.list_user') }}</h1>
</div>

<div id="filter">
    <div id="filter-header">
        <div>
            <button id="import-button" data-bs-toggle="modal" data-bs-target="#importUsers">
                <i class="bi bi-cloud-upload-fill"></i>
            </button>
        </div>
        <div>
            <button id="filter-button">
                <i class="bi bi-filter"></i>
            </button>
        </div>
    </div>
    <form id="filter-form" class="filter-form filter-form-closed-base" method="post" style="max-height: 0px;" action="{{ route('user_list') }}">
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
            <div class="col-lg-1 offset-lg-1 col-3">
                <label for="rol">{{ trans('translation.role') }}:</label>
            </div>
            <div class="col-lg-4 col-9">
                @if (isset($request->rol) && $request->rol != "")
                <select class="form-select" id="rol" name="rol" value="{{ $request->rol }}">
                    <option value="">{{ trans('translation.select_rol') }}</option>
                    @foreach($rols as $rol)
                    @if ($request->rol == $rol->id)
                    <option value="{{ $rol->id }}" selected>{{ $rol->name }}</option>
                    @else
                    <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                    @endif
                    @endforeach
                </select>
                @else
                <select class="form-select" id="rol" name="rol">
                    <option value="">{{ trans('translation.select_rol') }}</option>
                    @foreach($rols as $rol)
                    <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                    @endforeach
                </select>
                @endif
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-1 col-3">
                <label for="cicle">{{ trans('translation.cicle') }}:</label>
            </div>
            <div class="col-lg-4 col-9">
                @if (isset($request->cicle) && $request->cicle != "")
                <select class="form-select" id="cicle" name="cicle" value="{{ $request->cicle }}">
                    <option value="">{{ trans('translation.select_cicle') }}</option>
                    @foreach($cicles as $cicle)
                    @if ($request->cicle == $cicle->id)
                    <option value="{{ $cicle->id }}" selected>{{ $cicle->shortname }} - {{ $cicle->name }}</option>
                    @else
                    <option value="{{ $cicle->id }}">{{ $cicle->shortname }} - {{ $cicle->name }}</option>
                    @endif
                    @endforeach
                </select>
                @else
                <select class="form-select" id="cicle" name="cicle">
                    <option value="">{{ trans('translation.select_cicle') }}</option>
                    @foreach($cicles as $cicle)
                    <option value="{{ $cicle->id }}">{{ $cicle->shortname }} - {{ $cicle->name }}</option>
                    @endforeach
                </select>
                @endif
            </div>
            <div class="col-lg-1 offset-lg-1 col-3"></div>
            <div class="col-lg-4 col-9"></div>
        </div>
        <div id="filter-form-button">
            <input class="btn btn-danger" type="button" onclick="reiniciarFiltres()" value="{{ trans('translation.reset') }}" />
            <input class="btn btn-secondary" type="submit" id="btnFiltrar" value="{{ trans('translation.filter') }}" />
        </div>
    </form>
</div>

<div class="modal fade" id="newUsuari" tabindex="-1" aria-labelledby="newUsuariLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newUsuariLabel">{{ trans('translation.create_user') }}</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>
            <form method="POST" name="addUserForm" action="{{ route('user_new') }}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-2 col-12">
                            <label class="col-form-label" for="firstname">{{ trans('translation.name') }}</label>
                        </div>
                        <div class="col-md-10 col-12">
                            <input class="form-control" type="text" name="name" />
                        </div>
                        <div class="error" id="name-add-user-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-12">
                            <label class="col-form-label" for="email">{{ trans('translation.email') }}</label>
                        </div>
                        <div class="col-md-10 col-12">
                            <input class="form-control" type="text" name="email" />
                        </div>
                        <div class="error" id="email-add-user-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-12">
                            <label class="col-form-label" for="cicle_id">{{ trans('translation.cicle') }}</label>
                        </div>
                        <div class="col-md-10 col-12">
                            <select class="form-select" name="cicle_id">
                                <option value="default">{{ trans('translation.select_cicle') }}</option>
                                @foreach ($cicles as $cicle)
                                <option value="{{ $cicle->id }}">{{ $cicle->shortname }} - {{ $cicle->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="error" id="cicle_id-add-user-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-12">
                            <label class="col-form-label" for="rol_id">{{ trans('translation.role') }}</label>
                        </div>
                        <div class="col-md-10 col-12">
                            <select class="form-select" name="rol_id">
                                <option value="default">{{ trans('translation.select_rol') }}</option>
                                @foreach ($rols as $rol)
                                <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="error" id="rol_id-add-user-error"></div>
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

@if (session('status'))
<div>
    <strong>Success!</strong> {{ session('status') }}
</div>
@endif

<div class="table-responsive">
    <table id="usuari-table" class="table table-striped table-dark">
        <thead>
            <tr>
                <th>{{ trans('translation.name') }}</th>
                <th>{{ trans('translation.email') }}</th>
                <th>{{ trans('translation.cicle') }}</th>
                <th>{{ trans('translation.role') }}</th>
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
                <td><a href="{{ route('user_detail', $user->id) }}">{{ $user->name }}</a></td>
                <td><a href="{{ route('user_detail', $user->id) }}">{{ $user->email }}</a></td>
                <td>
                    <form action="{{ route('user_list') }}" method="GET">
                        <input type="hidden" name="cicle" value="{{ $user->cicle->id }}" />
                        <a href="#" onclick="this.parentNode.submit()">{{ $user->cicle->shortname }}</a>
                    </form>
                </td>
                <td>
                    <form action="{{ route('user_list') }}" method="GET">
                        <input type="hidden" name="rol" value="{{ $user->rol->id }}" />
                        <a href="#" onclick="this.parentNode.submit()">{{ $user->rol->name }}</a>
                    </form>
                </td>
                <td>
                    <a data-id="{{ $user->id }}" data-name="{{ $user->name }}" class="iconBasura" data-bs-toggle="modal" data-bs-target="#confirmDelete">
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
                <h5 class="modal-title" id="confirmDeleteLabel">{{ trans('translation.delete') .' '. trans('translation.user') }}</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>
            <form method="GET">
                @csrf
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

<div class="modal fade" id="importUsers" tabindex="-1" aria-labelledby="importUsersLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importUsersLabel">{{ trans('translation.import_csv') }}</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>
            <form id="addForm" name="importUsersForm" action="{{ route('user_import') }}" method="post" enctype="multipart/form-data">
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
<script type="text/javascript" src="{{ asset('js/user_add_validator.js') }}"></script>
@endsection