<style>
    .modal-body>.row {
        margin-top: 5px;
        margin-left: 10px;
    }

    @media screen and (max-width: 575px) {
        label {
            float: left;
        }
    }

    @media screen and (min-width: 576px) {
        label {
            float: right;
        }
    }

    #icon-basura {
        font-size: larger;
    }

    #icon-basura:hover {
        color: red;
    }
</style>
@extends('layout')

@section('title', 'Llistat de estadas')

@section('stylesheets')
@parent
@endsection

@section('content')
    <div class="titulo">
        <h1>Llistat de estadas</h1>
    </div>
    <div class="modal fade" id="novaEstada" tabindex="-1" aria-labelledby="novaEstadaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="width: 100%; text-align: center;" id="novaEstadaLabel">Afegir estada</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('estada_new') }}">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-2 col-sm-2">
                                <label class="col-form-label text-dark" for="student_name">Nom Estudiant</label>
                            </div>
                            <div class="col-md-10 col-sm-10">
                                <input class="form-control" type="text" name="student_name" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2">
                                <label class="col-form-label text-dark" for="cicle_id">Cicle</label>
                            </div>
                            <div class="col-md-10 col-sm-10">
                                <select class="form-select" name="cicle_id">
                                    @foreach ($cicles as $cicle)
                                        <option value="{{ $cicle->id }}">{{ $cicle->shortname }} - {{ $cicle->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2">
                                <label class="col-form-label text-dark" for="empresa_id">Empresa</label>
                            </div>
                            <div class="col-md-10 col-sm-10">
                                <select class="form-select" name="empresa_id">
                                    @foreach ($empresas as $empresa)
                                        <option value="{{ $empresa->id }}">{{ $empresa->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2">
                                <label class="col-form-label text-dark" for="evaluation">Valoració</label>
                            </div>
                            <div class="col-md-10 col-sm-10">
                                <input class="form-control" type="number" min="0" max="10" name="evaluation"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2">
                                <label class="col-form-label text-dark" for="comment">Comentari</label>
                            </div>
                            <div class="col-md-10 col-sm-10">
                                <input class="form-control" type="text" name="comment"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2">
                                <label class="col-form-label text-dark" for="dual">Dual</label>
                            </div>
                            <div class="col-md-10 col-sm-10">
                                <input class="form-control" type="text" name="dual" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2">
                                <label class="col-form-label text-dark" for="registered_by">Usuari</label>
                            </div>
                            <div class="col-md-10 col-sm-10">
                                <select class="form-select" name="registered_by">
                                    @foreach ($usuaris as $usuari)
                                        <option value="{{ $usuari->id }}">{{ $usuari->nomCognoms() }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2">
                                <label class="col-form-label text-dark" for="curs_id">Curs</label>
                            </div>
                            <div class="col-md-10 col-sm-10">
                                <select class="form-select" name="curs_id">
                                    @foreach ($cursos as $curs)
                                        <option value="{{ $curs->id }}">{{ $curs->name }}</option>
                                    @endforeach
                                </select>
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

    <div class="table-responsive" style=" height: 80vh; margin: auto ">
        <table class="table table-striped table-dark " style="margin-top: 20px;margin-bottom: 10px; -webkit-overflow-scrolling: auto">
    <thead>
        <tr>
            <th>Nom Estudiant</th>
            <th>Cicle ID</th>
            <th>Empresa ID</th>
            <th>Evaluation</th>
            <th>Comentaris</th>
            <th>Dual?</th>
            <th>Registrado por</th>
            <th>Curs ID</th>
            <th><a href="#" id="btnAfegirEstada" data-bs-toggle="modal" data-bs-target="#novaEstada">Nova estada</a></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($estadas as $estada)
        <tr>
            <td>{{ $estada->student_name }}</td>
            <td>{{ $estada->cicle_id }}</td>
            <td>{{ $estada->empresa_id }}</td>
            <td>{{ $estada->evaluation }}</td>
            <td>{{ $estada->comment }}</td>
            <td>{{ $estada->dual }}</td>
            <td>{{ $estada->registered_by }}</td>
            <td>{{ $estada->curs_id }}</td>
            <td>
                <a href="{{ route('estada_delete', ['id' => $estada->id]) }}"id="icon-basura"><i class="bi bi-trash3-fill"></i></a>
                <a href="{{ route('estada_edit', ['id' => $estada->id]) }}">Editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

    </div>
    <br>
@endsection
