@extends('layout')

@section('title', 'Llistat d\'empreses')

@section('stylesheets')
@parent
<link rel="stylesheet" href="{{ asset('css/empresaList.css') }}" />
<link rel="stylesheet" href="{{ asset('css/modalCrea.css') }}">
@endsection

@section('content')
<div class="titulo">
    <h1>Llistat d'empreses</h1>
</div>

<div id="filter">
    <div id="filter-header"><div><button id="import-button"><i class="bi bi-cloud-upload-fill"></i></button></div>
        <div>
            <button id="filter-button">
                <i class="bi bi-filter"></i>
            </button>
        </div>
    </div>
    <form id="filter-form" class="filter-form filter-form-closed-base" method="POST" action="{{ route('empresa_list') }}">
        @csrf
        <div id="filter-form-container">
            <div>
                <label for="cif">CIF:
                @if (isset($request->cif) && $request->cif != "")
                   <input type="text" id="cif" name="cif" value="{{ $request->cif }}"></input>
                @else
                    <input type="text" id="cif" name="cif"></input>
                @endif
                </label><br>

                <label for="cicle">Cicle:
                        @if (isset($request->cicle) && $request->cicle != "")
                        <select id="cicle" name="cicle" value="{{ $request->cicle }}">
                            <option value="">Selecciona un cicle...</option>
                            @foreach($cicles as $cicle)
                                @if ($request->cicle == $cicle->id)
                                    <option value="{{ $cicle->id }}" selected>{{ $cicle->shortname }} - {{ $cicle->name }}</option>
                                @else
                                    <option value="{{ $cicle->id }}">{{ $cicle->shortname }} - {{ $cicle->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @else
                        <select id="cicle" name="cicle">
                            <option value="">Selecciona un cicle...</option>
                            @foreach($cicles as $cicle)
                                <option value="{{ $cicle->id }}">{{ $cicle->shortname }} - {{ $cicle->name }}</option>
                            @endforeach
                        </select>
                        @endif
                </label><br>

                <label for="comarca">Comarca:
                    @if (isset($request->comarca) && $request->comarca != "")
                    <select id="comarca" name="comarca" value="{{ $request->comarca }}">
                        <option value="">Selecciona una comarca...</option>
                        @foreach($comarques as $comarca)
                            @if ($request->comarca == $comarca->id)
                                <option value="{{ $comarca->id }}" selected>{{ $comarca->name }}</option>
                            @else
                                <option value="{{ $comarca->id }}">{{ $comarca->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @else
                    <select id="comarca" name="comarca">
                        <option value="">Selecciona una comarca...</option>
                        @foreach($comarques as $comarca)
                            <option value="{{ $comarca->id }}">{{ $comarca->name }}</option>
                        @endforeach
                    </select>
                    @endif
                </label><br>

                <label id="estadas">Estadas:
                    @if (isset($request->minEstadas) && $request->minEstadas != "")
                        <input type="number" id="minEstadas" name="minEstadas" min=0 placeholder="Minim" value="{{ $request->minEstadas }}"></input>
                    @else
                        <input type="number" id="minEstadas" name="minEstadas" min=0 placeholder="Minim"></input>
                    @endif
                     -
                     @if (isset($request->maxEstadas) && $request->maxEstadas != "")
                        <input type="number" id="maxEstadas" name="maxEstadas" min=0 placeholder="Maxim" value="{{ $request->maxEstadas }}"></input>
                    @else
                        <input type="number" id="maxEstadas" name="maxEstadas" min=0 placeholder="Maxim"></input>
                    @endif
                </label><br>
            </div>
            <div>
                <label>Nom:
                @if (isset($request->name) && $request->name != "")
                   <input type="text" id="name" name="name" value="{{ $request->name }}"></input>
                @else
                    <input type="text" id="name" name="name"></input>
                @endif
                </label><br>

                <label>Sector:
                @if (isset($request->sector) && $request->sector != "")
                    <input type="text" id="sector" name="sector" list="sectors" value="{{ $request->sector }}"></input>
                @else
                    <input type="text" id="sector" name="sector" list="sectors"></input>
                @endif
                <datalist id="sectors">
                    @foreach($sectors as $sector)
                        <option value="{{ $sector->sector }}">
                    @endforeach
                </datalist>
                </label><br>

                <label for="poblacio">Poblacio:
                @if (isset($request->poblacio) && $request->poblacio != "")
                    <select id="poblacio" name="poblacio" value="{{ $request->poblacio }}">
                        <option value="">Selecciona una comarca...</option>
                    </select>
                @else
                    <select id="poblacio" name="poblacio">
                        <option value="">Selecciona una comarca...</option>
                    </select>
                @endif
                </label><br>

                <label id="valoracio">Valoracio:
                @if (isset($request->minEstadas) && $request->minEstadas != "")
                    <input type="number" id="minValoracio" name="minValoracio" min=0 placeholder="Minim" value="{{ $request->minValoracio }}"></input>
                @else
                    <input type="number" id="minValoracio" name="minValoracio" min=0 placeholder="Minim"></input>
                @endif
                    -
                @if (isset($request->maxEstadas) && $request->maxEstadas != "")
                    <input type="number" id="maxValoracio" name="maxValoracio" min=0 placeholder="Maxim" value="{{ $request->maxValoracio }}"></input>
                @else
                    <input type="number" id="maxValoracio" name="maxValoracio" min=0 placeholder="Maxim"></input>
                @endif
                </label><br>
            </div>
        </div>
        <div id="filter-form-button"><input type="submit" class="btn btn-secondary" value="Filtrar"></div>
    </form>
</div>
<table id="empresa-table" class="table table-striped table-dark">
    <thead>
        <tr>
            <th>CIF</th>
            <th>Nom</th>
            <th>Sector</th>
            <th>Població</th>
            <th>Nº Estades</th>
            <th>Valoració</th>
            <th>Contactes</th>
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
                <a data-id="{{ $empresa->id }}" class="iconBasura" data-bs-toggle="modal" data-bs-target="#confirmDelete">
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
                <h5 class="modal-title" id="addEmpresaLabel">Crear una empresa</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>
            <form id="addForm" name="addEmpresaForm" method="POST" action="{{ route('empresa_new') }}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="cif">CIF</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="cif" placeholder="Ex: A-00000000" required/>
                        </div>
                        <div class="error" id="cif-add-empresa-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="name">Nom</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="name" required/>
                        </div>
                        <div class="error" id="name-add-empresa-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="sector">Sector</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="sector" list="sectors" required/>
                        </div>
                        <div class="error" id="sector-add-empresa-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="comarca_id">Comarca</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-select" name="comarca_id" id="comarca_id">
                            <option value="">Selecciona una comarca...</option>
                                @foreach($comarques as $comarca)
                                    <option value="{{ $comarca->id }}">{{ $comarca->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="error" id="comarca_id-add-empresa-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="poblacio_id">Població</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-select" id="poblacio_id" name="poblacio_id">
                                <option value="default">Selecciona una comarca...</option>
                            </select>
                        </div>
                        <div class="error" id="poblacio_id-add-empresa-error"></div>
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

<div class="modal fade" id="confirmDelete" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">Eliminar empresa</h5>
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
                            });
                        });
                    </script>
                    @csrf
                    <p>Estàs segur de voler eliminar aquesta empresa?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="btnConfirmar">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/empresa_list_poblacions_json.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/filter_animation.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/filter_minDefiner.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/validators.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/empresa_add_validator.js') }}"></script>
@endsection
