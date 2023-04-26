@extends('layout')

@section('title', 'Llistat d\'estades')

@section('stylesheets')
@parent
<link rel="stylesheet" href="{{ asset('css/estadaList.css') }}" />
@endsection

@section('content')
<div class="titulo">
    <h1>Llistat d'estades</h1>
</div>

<div id="filter">
    <div id="filter-header">
        <div>
            <button id="import-button"><i class="bi bi-cloud-upload-fill"></i></button>
        </div>
        <div>
            <button id="filter-button"><i class="bi bi-filter"></i></button>
        </div>
    </div>
    <form id="filter-form" class="filter-form filter-form-closed-base" action="{{ route('estada_list') }}">
        <div id="filter-form-container">
            <div>
                <label>Nom alumne: 
                    @if (isset($request->name) && $request->name != "")
                    <input type="text" id="name" name="name" value="{{ $request->name }}"></input>
                    @else
                    <input type="text" id="name" name="name"></input>
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
                <label for="empresa">Empresa: 
                    @if (isset($request->empresa) && $request->empresa != "")
                        <input type="text" id="empresa" name="empresa" value="{{ $request->empresa }}"></input>
                    @else
                        <input type="text" id="empresa" name="empresa"></input>
                    @endif
                </input></label><br>
                <label id="valoracio">Valoracio:
                @if (isset($request->minEstadas) && $request->minEstadas != "")
                    <input type="number" id="minValoracio" name="minValoracio" min=0 value="{{ $request->minValoracio }}"></input>
                @else
                    <input type="number" id="minValoracio" name="minValoracio" min=0></input>
                @endif
                    - 
                @if (isset($request->maxEstadas) && $request->maxEstadas != "")
                    <input type="number" id="maxValoracio" name="maxValoracio" min=0 value="{{ $request->maxValoracio }}"></input>
                @else
                    <input type="number" id="maxValoracio" name="maxValoracio" min=0></input>
                @endif 
                </label><br>
            </div>
            <div>
                <label for="curs">Curs: 
                    @if (isset($request->curs) && $request->curs != "")
                    <select id="curs" name="curs" value="{{ $request->curs }}">
                        <option value="">Selecciona un curs...</option>
                        @foreach($cursos as $curs)
                            @if ($request->curs == $curs->id)
                                <option value="{{ $curs->id }}" selected>{{ $curs->name }}</option>
                            @else
                                <option value="{{ $curs->id }}">{{ $curs->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @else
                    <select id="curs" name="curs">
                        <option value="">Selecciona un curs...</option>
                        @foreach($cursos as $curs)
                            <option value="{{ $curs->id }}">{{ $curs->name }}</option>
                        @endforeach
                    </select>
                    @endif
                </label><br>
                <label for="registeredBy">Registrat per: 
                    @if (isset($request->registeredBy) && $request->registeredBy != "")
                        <input type="text" id="registeredBy" name="registeredBy" value="{{ $request->registeredBy }}"></input>
                    @else
                        <input type="text" id="registeredBy" name="registeredBy"></input>
                    @endif
                </input></label><br>
                <label for="tipus">Tipus: 
                    @if (isset($request->tipus) && $request->tipus != "")
                    <select id="tipus" name="tipus" value="{{ $request->tipus }}">
                        <option value="">Selecciona el tipus...</option>
                        @if ($request->tipus == 0)
                            <option value="0" selected>FCT</option>
                            <option value="1">Dual</option>
                        @elseif ($request->tipus == 1)
                            <option value="0">FCT</option>
                            <option value="1" selected>Dual</option>
                        @endif
                    </select>
                    @else
                    <select id="tipus" name="tipus">
                        <option value="">Selecciona el tipus...</option>
                        <option value="0">FCT</option>
                        <option value="1">Dual</option>
                    </select>
                    @endif
                </label><br>
            </div>
        </div>
        <div id="filter-form-button"><input type="submit" value="Filtrar"></div>
    </form>
</div>

<div class="modal fade" id="newEstada" tabindex="-1" aria-labelledby="newEstadaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newEstadaLabel">Crear una estada</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" name="addEstadaForm" action="{{ route('estada_new') }}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="student_name">Nom Alumne</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="student_name" required/>
                        </div>
                        <div class="error" id="student_name-add-estada-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="curs_id">Curs</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-select" type="text" name="curs_id">
                                <option value="default">Selecciona un curs...</option>
                                @foreach($cursos as $curs)
                                <option value="{{ $curs->id }}">{{ $curs->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="error" id="curs_id-add-estada-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="cicle_id">Cicle</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-select" type="text" name="cicle_id">
                                <option value="default">Selecciona un cicle...</option>
                                @foreach($cicles as $cicle)
                                <option value="{{ $cicle->id }}">{{ $cicle->shortname }} - {{ $cicle->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="error" id="cicle_id-add-estada-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="registered_by">Registrat per</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-select" type="text" name="registered_by">
                                <option value="default">Selecciona un tutor...</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="error" id="registered_by-add-estada-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="empresa_id">Empresa</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-select" name="empresa_id">
                                <option value="default">Selecciona una empresa...</option>
                                @foreach ($empresas as $empresa)
                                <option value="{{ $empresa->id }}">{{ $empresa->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="error" id="empresa_id-add-estada-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="dual">Tipus</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-select" type="text" name="dual">
                                <option value="default">Selecciona el tipus...</option>
                                <option value="0">FCT</option>
                                <option value="1">Dual</option>
                            </select>
                        </div>
                        <div class="error" id="dual-add-estada-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="evaluation">Valoració</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="number" min="0" max="10" value="5" name="evaluation" required/>
                        </div>
                        <div class="error" id="evaluation-add-estada-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="comment">Comentaris</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="comment"/>
                        </div>
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

<table id="estada-table" class="table table-striped table-dark">
    <thead>
        <tr>
            <th>Alumne</th>
            <th>Curs</th>
            <th>Cicle</th>
            <th>Registrat per</th>
            <th>Empresa</th>
            <th>Tipus</th>
            <th>Valoració</th>
            <th>Comentaris</th>
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
            <td><a href="{{ route('estada_detail', $estada->id) }}">{{ $estada->comment }}</a></td>
            <td>
                <a data-id="{{ $estada->id }}" class="iconBasura" data-bs-toggle="modal" data-bs-target="#confirmDelete"><i class="bi bi-trash3-fill"></i></a>
                <!-- <a href="{{ route('estada_edit', ['id' => $estada->id]) }}">Editar</a> -->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="modal fade" id="confirmDelete" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">Eliminar estada</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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
                    <p>Estàs segur de voler eliminar aquesta estada?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="btnConfirmar">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/filter_animation.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/validators.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/estada_add_validator.js') }}"></script>
@endsection
