@extends('layout')

@section('title', trans('translation.list_estades'))

@section('stylesheets')
@parent
<link rel="stylesheet" href="{{ asset('css/estadaList.css') }}" />
@endsection

@section('content')
<div class="titulo">
    <h1>{{ trans('translation.list_estades') }}</h1>
</div>

<div id="filter">
    <div id="filter-header">
        <div>
            <button id="import-button" data-bs-toggle="modal" data-bs-target="#importEstades">
                <i class="bi bi-cloud-upload-fill"></i>
            </button>
        </div>
        <div>
            <button id="filter-button">
                <i class="bi bi-filter"></i>
            </button>
        </div>
    </div>
    <form id="filter-form" class="filter-form filter-form-closed-base" method="post" style="max-height: 0px;" action="{{ route('estada_list') }}">
        @csrf
        <div class="row d-flex justify-content-center">
            <div class="col-lg-1 col-3">
                <label for="name">{{ trans('translation.student') }}:</label>
            </div>
            <div class="col-lg-4 col-9">
                @if (isset($request->name) && $request->name != "")
                <input class="form-control" type="text" id="name" name="name" value="{{ $request->name }}" />
                @else
                <input class="form-control" type="text" id="name" name="name" />
                @endif
            </div>
            <div class="col-lg-1 offset-lg-1 col-3">
                <label for="curs">{{ trans('translation.course') }}:</label>
            </div>
            <div class="col-lg-4 col-9">
                @if (isset($request->curs) && $request->curs != "")
                <select class="form-select" id="curs" name="curs" value="{{ $request->curs }}">
                    <option value="">{{ trans('translation.select_course') }}</option>
                    @foreach($cursos as $curs)
                    @if ($request->curs == $curs->id)
                    <option value="{{ $curs->id }}" selected>{{ $curs->name }}</option>
                    @else
                    <option value="{{ $curs->id }}">{{ $curs->name }}</option>
                    @endif
                    @endforeach
                </select>
                @else
                <select class="form-select" id="curs" name="curs">
                    <option value="">{{ trans('translation.select_course') }}</option>
                    @foreach($cursos as $curs)
                    <option value="{{ $curs->id }}">{{ $curs->name }}</option>
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
            <div class="col-lg-1 offset-lg-1 col-3">
                <label for="registeredBy">{{ trans('translation.registered_by') }}:</label>
            </div>
            <div class="col-lg-4 col-9">
                @if (isset($request->registeredBy) && $request->registeredBy != "")
                <input class="form-control" type="text" id="registeredBy" name="registeredBy" value="{{ $request->registeredBy }}" autocomplete="off" list="registered_by" />
                @else
                <input class="form-control" type="text" id="registeredBy" name="registeredBy" autocomplete="off" list="registered_by" />
                @endif
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-1 col-3">
                <label for="empresa">{{ trans('translation.company') }}:</label>
            </div>
            <div class="col-lg-4 col-9">
                @if (isset($request->empresa) && $request->empresa != "")
                <input class="form-control" type="text" id="empresa" name="empresa" value="{{ $request->empresa }}" autocomplete="off" list="empresas" />
                @else
                <input class="form-control" type="text" id="empresa" name="empresa" autocomplete="off" list="empresas" />
                @endif
            </div>
            <div class="col-lg-1 offset-lg-1 col-3">
                <label for="tipus">{{ trans('translation.type') }}:</label>
            </div>
            <div class="col-lg-4 col-9">
                @if (isset($request->tipus) && $request->tipus != "")
                <select class="form-select" id="tipus" name="tipus" value="{{ $request->tipus }}">
                    <option value="">{{ trans('translation.select_type') }}</option>
                    @if ($request->tipus == 0)
                    <option value="0" selected>FCT</option>
                    <option value="1">Dual</option>
                    @elseif ($request->tipus == 1)
                    <option value="0">FCT</option>
                    <option value="1" selected>Dual</option>
                    @endif
                </select>
                @else
                <select class="form-select" id="tipus" name="tipus">
                    <option value="">{{ trans('translation.select_type') }}</option>
                    <option value="0">FCT</option>
                    <option value="1">Dual</option>
                </select>
                @endif
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-1 col-3">
                <label for="valoracio">{{ trans('translation.valoration') }}:</label>
            </div>
            <div class="col-lg-4 col-9">
                <div class="row g-0">
                    <div class="col-lg-5 col-5">
                        @if (isset($request->minValoracio) && $request->minValoracio != "")
                        <input class="form-control" type="number" id="minValoracio" placeholder="{{ trans('translation.min') }}" name="minValoracio" min="0" max="10" value="{{ $request->minValoracio }}" />
                        @else
                        <input class="form-control" type="number" id="minValoracio" placeholder="{{ trans('translation.min') }}" name="minValoracio" min="0" max="10" />
                        @endif
                    </div>
                    <div class="col-lg-2 col-2 text-center">-</div>
                    <div class="col-lg-5 col-5">
                        @if (isset($request->maxValoracio) && $request->maxValoracio != "")
                        <input class="form-control" type="number" id="maxValoracio" placeholder="{{ trans('translation.max') }}" name="maxValoracio" min="0" max="10" value="{{ $request->maxValoracio }}" />
                        @else
                        <input class="form-control" type="number" id="maxValoracio" placeholder="{{ trans('translation.max') }}" name="maxValoracio" min="0" max="10" />
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-1 offset-lg-1 col-3">
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

<div class="modal fade" id="newEstada" tabindex="-1" aria-labelledby="newEstadaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newEstadaLabel">{{ trans('translation.create_stay') }}</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>
            <form method="POST" name="addEstadaForm" action="{{ route('estada_new') }}">
                <input type="hidden" name="redirect_to" value="estada_list">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-2 col-12">
                            <label class="col-form-label" for="student_name">{{ trans('translation.student') }}</label>
                        </div>
                        <div class="col-md-10 col-12">
                            <input class="form-control" type="text" name="student_name" />
                        </div>
                        <div class="error" id="student_name-add-estada-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2  col-12">
                            <label class="col-form-label" for="curs_id">{{ trans('translation.course') }}</label>
                        </div>
                        <div class="col-md-10 col-12">
                            <select class="form-select" type="text" name="curs_id">
                                <option value="default">{{ trans('translation.select_course') }}</option>
                                @foreach($cursos as $curs)
                                <option value="{{ $curs->id }}">{{ $curs->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="error" id="curs_id-add-estada-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2  col-12">
                            <label class="col-form-label" for="cicle_id">{{ trans('translation.cicle') }}</label>
                        </div>
                        <div class="col-md-10 col-12">
                            <select class="form-select" type="text" name="cicle_id">
                                <option value="default">{{ trans('translation.select_cicle') }}</option>
                                @foreach($cicles as $cicle)
                                <option value="{{ $cicle->id }}">{{ $cicle->shortname }} - {{ $cicle->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="error" id="cicle_id-add-estada-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2  col-12">
                            <label class="col-form-label" for="registered_by">{{ trans('translation.registered_by') }}</label>
                        </div>
                        <div class="col-md-10 col-12">
                            <select class="form-select" type="text" name="registered_by">
                                <option value="default">{{ trans('translation.select_tutor') }}</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="error" id="registered_by-add-estada-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2  col-12">
                            <label class="col-form-label" for="empresa_id">{{ trans('translation.company') }}</label>
                        </div>
                        <div class="col-md-10 col-12">
                            <select class="form-select" name="empresa_id">
                                <option value="default">{{ trans('translation.select_company') }}</option>
                                @foreach ($empresas as $empresa)
                                <option value="{{ $empresa->id }}">{{ $empresa->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="error" id="empresa_id-add-estada-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2  col-12">
                            <label class="col-form-label" for="dual">{{ trans('translation.type') }}</label>
                        </div>
                        <div class="col-md-10 col-12">
                            <select class="form-select" type="text" name="dual">
                                <option value="default">{{ trans('translation.select_type') }}</option>
                                <option value="0">FCT</option>
                                <option value="1">Dual</option>
                            </select>
                        </div>
                        <div class="error" id="dual-add-estada-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2  col-12">
                            <label class="col-form-label" for="evaluation">{{ trans('translation.valoration') }}</label>
                        </div>
                        <div class="col-md-10 col-12">
                            <input class="form-control" type="number" min="0" max="10" value="5" name="evaluation" />
                        </div>
                        <div class="error" id="evaluation-add-estada-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2  col-12">
                            <label class="col-form-label" for="comment">{{ trans('translation.comment') }}</label>
                        </div>
                        <div class="col-md-10 col-12">
                            <input class="form-control" type="text" name="comment" />
                        </div>
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
    <table id="estada-table" class="table table-striped table-dark">
        <thead>
            <tr>
                <th>{{ trans('translation.student') }}</th>
                <th>{{ trans('translation.course') }}</th>
                <th>{{ trans('translation.cicle') }}</th>
                <th>{{ trans('translation.registered_by') }}</th>
                <th>{{ trans('translation.company') }}</th>
                <th>{{ trans('translation.type') }}</th>
                <th>{{ trans('translation.valoration') }}</th>
                <th>
                    <a class="iconAdd" data-bs-toggle="modal" data-bs-target="#newEstada">
                        <i class="bi bi-plus-square-fill"></i>
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($estadas as $estada)
            <tr>
                <td><a href="{{ route('estada_detail', $estada->id) }}">{{ $estada->student_name }}</a></td>
                <td>
                    <form action="{{ route('estada_list') }}" method="GET">
                        <input type="hidden" name="curs" value="{{ $estada->curs->id }}" />
                        <a href="#" onclick="this.parentNode.submit()">{{ $estada->curs->name }}</a>
                    </form>
                </td>
                <td>
                    <form action="{{ route('estada_list') }}" method="GET">
                        <input type="hidden" name="cicle" value="{{ $estada->cicle->id }}" />
                        <a href="#" onclick="this.parentNode.submit()">{{ $estada->cicle->shortname }}</a>
                    </form>
                </td>
                <td>
                    <form action="{{ route('estada_list') }}" method="GET">
                        <input type="hidden" name="registeredBy" value="{{ $estada->tutor() }}" />
                        <a href="#" onclick="this.parentNode.submit()">{{ $estada->tutor() }}</a>
                    </form>
                </td>
                <td>
                    <form action="{{ route('estada_list') }}" method="GET">
                        <input type="hidden" name="empresa" value="{{ $estada->empresa->name }}" />
                        <a href="#" onclick="this.parentNode.submit()">{{ $estada->empresa->name }}</a>
                    </form>
                </td>
                <td>
                    <form action="{{ route('estada_list') }}" method="GET">
                        <input type="hidden" name="tipus" value="{{ $estada->dual }}" />
                        @if ($estada->dual == 1)
                        <a href="#" onclick="this.parentNode.submit()">Dual</a>
                        @else
                        <a href="#" onclick="this.parentNode.submit()">FCT</a>
                        @endif
                    </form>
                </td>
                <td>
                    <form action="{{ route('estada_list') }}" method="GET">
                        <input type="hidden" name="minValoracio" value="{{ $estada->evaluation }}" />
                        <input type="hidden" name="maxValoracio" value="{{ $estada->evaluation }}" />
                        <a href="#" onclick="this.parentNode.submit()">{{ $estada->evaluation }}</a>
                    </form>
                </td>
                <td>
                    <a data-id="{{ $estada->id }}" data-name="{{ $estada->student_name }}" class="iconBasura" data-bs-toggle="modal" data-bs-target="#confirmDelete"><i class="bi bi-trash3-fill"></i></a>
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
                <h5 class="modal-title" id="confirmDeleteLabel">{{ trans('translation.delete_stay') }}</h5>
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

<div class="modal fade" id="importEstades" tabindex="-1" aria-labelledby="importEstadesLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importEstadesLabel">{{ trans('translation.import_csv') }}</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>
            <form id="addForm" name="importEstadesForm" action="{{ route('estada_import') }}" method="post" enctype="multipart/form-data">
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

<datalist id="registered_by">
    @foreach($users as $user)
        <option value="{{ $user->name }}">
    @endforeach
</datalist>

<datalist id="empresas">
    @foreach($empresas as $empresa)
        <option value="{{ $empresa->name }}">
    @endforeach
</datalist>

<script type="text/javascript" src="{{ asset('js/filter_animation.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/filter_size.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/reiniciar_filtres.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/validators.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/estada_add_validator.js') }}"></script>
@endsection