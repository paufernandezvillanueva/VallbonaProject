@extends('layout')

@section('title', trans('translation.list_empresa'))

@section('stylesheets')
@parent
<link rel="stylesheet" href="{{ asset('css/empresaList.css') }}" />
<link rel="stylesheet" href="{{ asset('css/modalCrea.css') }}">
@endsection

@section('content')
<div class="titulo">
    <h1> {{ trans('translation.list_empresa') }}</h1>
</div>

<div id="filter">
    <div id="filter-header">
        <div>
            <button id="import-button" data-bs-toggle="modal" data-bs-target="#importEmpreses">
                <i class="bi bi-cloud-upload-fill"></i>
            </button>
        </div>
        <div>
            <button id="filter-button">
                <i class="bi bi-filter"></i>
            </button>
        </div>
    </div>
    <form id="filter-form" class="filter-form filter-form-closed-base" method="post" style="max-height: 0px;" action="{{ route('empresa_list') }}">
        @csrf
        <div class="row d-flex justify-content-center">
            <div class="col-lg-1 col-3">
                <label for="cif">{{ trans('translation.cif') }}:</label>
            </div>
            <div class="col-lg-4 col-9">
                @if (isset($request->cif) && $request->cif != "")
                <input class="form-control" type="text" id="cif" name="cif" value="{{ $request->cif }}"></input>
                @else
                <input class="form-control" type="text" id="cif" name="cif"></input>
                @endif
            </div>
            <div class="col-lg-1 offset-lg-1 col-3">
                <label for="nom">{{ trans('translation.name') }}:</label>
            </div>
            <div class="col-lg-4 col-9">
                @if (isset($request->name) && $request->name != "")
                <input class="form-control" type="text" id="name" name="name" value="{{ $request->name }}"></input>
                @else
                <input class="form-control" type="text" id="name" name="name"></input>
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
                    <option value=""> {{ trans('translation.select_cicle') }} </option>
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
                <label for="sector">{{ trans('translation.sector') }}:</label>
            </div>
            <div class="col-lg-4 col-9">
                @if (isset($request->sector) && $request->sector != "")
                <input autocomplete="off" class="form-control" type="text" id="sector" name="sector" value="{{ $request->sector }}" autocomplete="off" list="sectors"></input>
                @else
                <input class="form-control" type="text" id="sector" name="sector" autocomplete="off" list="sectors"></input>
                @endif
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-1 col-3">
                <label for="comarca">{{ trans('translation.comarca') }}:</label>
            </div>
            <div class="col-lg-4 col-9">
                @if (isset($request->comarca) && $request->comarca != "")
                <select class="form-select" id="comarca" name="comarca" value="{{ $request->comarca }}">
                    <option value="">{{ trans('translation.select_comarca') }}</option>
                    @foreach($comarques as $comarca)
                    @if ($request->comarca == $comarca->id)
                    <option value="{{ $comarca->id }}" selected>{{ $comarca->name }}</option>
                    @else
                    <option value="{{ $comarca->id }}">{{ $comarca->name }}</option>
                    @endif
                    @endforeach
                </select>
                @else
                <select class="form-select" id="comarca" name="comarca">
                    <option value="">{{ trans('translation.select_comarca') }}</option>
                    @foreach($comarques as $comarca)
                    <option value="{{ $comarca->id }}">{{ $comarca->name }}</option>
                    @endforeach
                </select>
                @endif
            </div>
            <div class="col-lg-1 offset-lg-1 col-3">
                <label for="poblacio">{{ trans('translation.city') }}:</label>
            </div>
            <div class="col-lg-4 col-9">
                @if (isset($request->poblacio) && $request->poblacio != "")
                <select class="form-select" id="poblacio" name="poblacio" value="{{ $request->poblacio }}">
                    <option value="">{{ trans('translation.select_poblacio') }}</option>
                </select>
                @else
                <select class="form-select" id="poblacio" name="poblacio">
                    <option value="">{{ trans('translation.select_poblacio') }}</option>
                </select>
                @endif
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-1 col-3">
                <label for="estadas">{{ trans('translation.estades') }}:</label>
            </div>
            <div class="col-lg-4 col-9">
                <div class="row g-0">
                    <div class="col-lg-5 col-5">
                        @if (isset($request->minEstadas) && $request->minEstadas != "")
                        <input class="form-control" type="number" id="minEstadas" placeholder="{{ trans('translation.min') }}" name="minEstadas" min="0" value="{{ $request->minEstadas }}" />
                        @else
                        <input class="form-control" type="number" id="minEstadas" placeholder="{{ trans('translation.min') }}" name="minEstadas" min="0" />
                        @endif
                    </div>
                    <div class="col-lg-2 col-2 text-center">-</div>
                    <div class="col-lg-5 col-5">
                        @if (isset($request->maxEstadas) && $request->maxEstadas != "")
                        <input class="form-control" type="number" id="maxEstadas" placeholder="{{ trans('translation.max') }}" name="maxEstadas" min="0" value="{{ $request->maxEstadas }}" />
                        @else
                        <input class="form-control" type="number" id="maxEstadas" placeholder="{{ trans('translation.max') }}" name="maxEstadas" min="0"></input>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-1 offset-lg-1 col-3">
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
        </div>
        <div id="filter-form-button">
            <input class="btn btn-danger" type="button" onclick="reiniciarFiltres()" value="{{ trans('translation.reset') }}" />
            <input class="btn btn-secondary" type="submit" id="btnFiltrar" value="{{ trans('translation.filter') }}" />
        </div>
    </form>
</div>

<table id="empresa-table" class="table table-striped table-dark">
    <thead>
        <tr>
            <th>{{ trans('translation.cif') }}</th>
            <th>{{ trans('translation.name') }}</th>
            <th>{{ trans('translation.sector') }}</th>
            <th>{{ trans('translation.city') }}</th>
            <th>{{ trans('translation.estades') }}</th>
            <th>{{ trans('translation.valoration') }}</th>
            <th>{{ trans('translation.contacts') }}</th>
            <th>
                <a class="iconAdd" data-bs-toggle="modal" data-bs-target="#addEmpresa">
                    <i class="bi bi-plus-square-fill"></i>
                </a>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($empresas as $empresa)
        <tr>
            <td><a href="{{ route('empresa_detail', $empresa->id) }}">{{ $empresa->cif }}</a></td>
            <td><a href="{{ route('empresa_detail', $empresa->id) }}">{{ $empresa->name }}</a></td>
            <td>
                <form action="{{ route('empresa_list') }}" method="GET">
                    <input type="hidden" name="sector" value="{{ $empresa->sector }}" />
                    <a href="#" onclick="this.parentNode.submit()">{{ $empresa->sector }}</a>
                </form>
            </td>
            <td>
                <form action="{{ route('empresa_list') }}" method="GET">
                    <input type="hidden" name="poblacio" value="{{ $empresa->poblacio_id }}" />
                    <a href="#" onclick="this.parentNode.submit()">{{ $empresa->poblacio->name }}</a>
                </form>
            </td>
            <td>
                <form action="{{ route('empresa_list') }}" method="GET">
                    <input type="hidden" name="minEstadas" value="{{ $empresa->countEstades() }}" />
                    <input type="hidden" name="maxEstadas" value="{{ $empresa->countEstades() }}" />
                    <a href="#" onclick="this.parentNode.submit()">{{ $empresa->countEstades() }}</a>
                </form>
            </td>
            <td>
                @if ($empresa->avgValoracio() != "Ninguna")
                <form action="{{ route('empresa_list') }}" method="GET">
                    <input type="hidden" name="minValoracio" value="{{ $empresa->avgValoracio() }}" />
                    <input type="hidden" name="maxValoracio" value="{{ $empresa->avgValoracio() }}" />
                    <a href="#" onclick="this.parentNode.submit()">{{ $empresa->avgValoracio() }}</a>
                </form>
                @else
                <form action="{{ route('empresa_list') }}" method="GET">
                    <input type="hidden" name="maxValoracio" value="{{ $empresa->avgValoracio() }}" />
                    <a href="#" onclick="this.parentNode.submit()">{{ $empresa->avgValoracio() }}</a>
                </form>
                @endif
            </td>
            <td><a href="{{ route('empresa_detail', $empresa->id) }}">{{ $empresa->contactes() }}</a></td>
            <td>
                <a data-id="{{ $empresa->id }}" data-name="{{ $empresa->name }}" class="iconBasura" data-bs-toggle="modal" data-bs-target="#confirmDelete">
                    <i class="bi bi-trash3-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="modal fade" id="addEmpresa" tabindex="-1" aria-labelledby="addEmpresaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEmpresaLabel">{{ trans('translation.create_empresa') }}</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>
            <form id="addForm" name="addEmpresaForm" method="POST" action="{{ route('empresa_new') }}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-2 col-12">
                            <label class="col-form-label" for="cif">{{ trans('translation.cif') }}</label>
                        </div>
                        <div class="col-md-10 col-12">
                            <input class="form-control" type="text" name="cif" placeholder="Ex: A-00000000" />
                        </div>
                        <div class="error" id="cif-add-empresa-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-12">
                            <label class="col-form-label" for="name">{{ trans('translation.name') }}</label>
                        </div>
                        <div class="col-md-10 col-12">
                            <input class="form-control" type="text" name="name" />
                        </div>
                        <div class="error" id="name-add-empresa-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-12">
                            <label class="col-form-label" for="sector">{{ trans('translation.sector') }}</label>
                        </div>
                        <div class="col-md-10 col-12">
                            <input class="form-control" type="text" name="sector" list="sectors" />
                        </div>
                        <div class="error" id="sector-add-empresa-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-12">
                            <label class="col-form-label" for="comarca_id">{{ trans('translation.comarca') }}</label>
                        </div>
                        <div class="col-md-10 col-12">
                            <select class="form-select" name="comarca_id" id="comarca_id">
                                <option value="">{{ trans('translation.select_comarca') }}</option>
                                @foreach($comarques as $comarca)
                                <option value="{{ $comarca->id }}">{{ $comarca->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="error" id="comarca_id-add-empresa-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-12">
                            <label class="col-form-label" for="poblacio_id">{{ trans('translation.city') }}</label>
                        </div>
                        <div class="col-md-10 col-12">
                            <select class="form-select" id="poblacio_id" name="poblacio_id">
                                <option value="default">{{ trans('translation.select_comarca') }}</option>
                            </select>
                        </div>
                        <div class="error" id="poblacio_id-add-empresa-error"></div>
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

<div class="modal fade" id="confirmDelete" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">{{ trans('translation.delete_empresa') }}</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>
            <form method="GET">
                <div class="modal-body">
                    <script>
                        document.querySelectorAll('.iconBasura').forEach(elem => {
                            elem.addEventListener('click', () => {
                                var dataId = elem.dataset.id;
                                var form = document.querySelector('#confirmDelete form');
                                form.action = "empresa/delete/" + dataId;
                                console.log(form.action);

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

<div class="modal fade" id="importEmpreses" tabindex="-1" aria-labelledby="importEmpresesLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importEmpresesLabel">{{ trans('translation.import_csv') }}</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>
            <form id="addForm" name="importEmpresesForm" action="{{ route('empresa_import') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="csv">CSV</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" placeholder="Ex: A-00000000" type="file" name="csv" id="csv" accept=".csv" />
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

<datalist id="sectors">
    @foreach($sectors as $sector)
        <option value="{{ $sector->sector }}">
    @endforeach
</datalist>

<script type="text/javascript" src="{{ asset('js/empresa_list_poblacions_json.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/filter_animation.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/filter_size.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/filter_minDefiner.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/reiniciar_filtres.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/validators.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/empresa_add_validator.js') }}"></script>
@endsection
