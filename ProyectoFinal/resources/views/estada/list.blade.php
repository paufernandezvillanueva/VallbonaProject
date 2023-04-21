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

<div class="modal fade" id="newEstada" tabindex="-1" aria-labelledby="newEstadaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newEstadaLabel">Crear una estada</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('estada_new') }}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="student_name">Nom Estudiant</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="student_name" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="curs_id">Curs</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-select" type="text" name="curs_id">
                                <option>Selecciona un curs...</option>
                                @foreach($cursos as $curs)
                                <option value="{{ $curs->id }}">{{ $curs->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="cicle_id">Cicle</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-select" type="text" name="cicle_id">
                                <option>Selecciona un cicle...</option>
                                @foreach($cicles as $cicle)
                                <option value="{{ $cicle->id }}">{{ $cicle->shortname }} - {{ $cicle->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="registered_by">Registrat per</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-select" type="text" name="registered_by">
                                <option>Selecciona un tutor...</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="empresa_id">Empresa</label>
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
                            <label class="col-form-label" for="dual">Tipus estada</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-select" type="text" name="dual">
                                <option>Selecciona un tipus d'estada...</option>
                                <option value="0">FCT</option>
                                <option value="1">Dual</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="evaluation">Evaluation</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="number" min="0" max="10" value="5" name="evaluation" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="comment">Comentaris</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="comment" />
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

<table id="estada-table" class="table table-striped table-dark">
    <thead>
        <tr>
            <th>Nom Estudiant</th>
            <th>Cicle</th>
            <th>Empresa</th>
            <th>Valoració</th>
            <th>Comentaris</th>
            <th>Tipus Estància</th>
            <th>Registrat per</th>
            <th>Curs</th>
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
            <td><a>{{ $estada->cicle->shortname }}</a></td>
            <td><a>{{ $estada->empresa->name }}</a></td>
            <td><a>{{ $estada->evaluation }}</a></td>
            <td id="comentari"><a>{{ $estada->comment }}</a></td>
            @if ($estada->dual == 1)
            <td><a>Dual</a></td>
            @else
            <td><a>FCT</a></td>
            @endif
            <td><a>{{ $estada->tutor() }}</a></td>
            <td><a>{{ $estada->curs->name }}</a></td>
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
@endsection