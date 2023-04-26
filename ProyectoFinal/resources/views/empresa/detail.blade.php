@extends('layout')

@section('title', $empresa->name)

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/empresaDetail.css') }}" />
@parent
@endsection

@section('content')
<div class="titulo">
    <h1>{{ $empresa->name }}</h1>
</div>

<div class="containerEmpresa">
    <div>
        <div class="btnTorna">
            <a href="{{ route('empresa_list') }}"><i class="bi bi-arrow-left-circle-fill"></i> Torna</a>
        </div>
        <div class="labels">
            <div class="infoEmpresa">
                <div class="list-header">
                    <div id="info">Info empresa</div>
                    <div class="filtro"><button class="filtrar" data-bs-toggle="modal" data-bs-target="#editInfo">Editar Informació</button></div>
                </div>
                <table id="info-table" class="table table-striped table-dark">
                    <tr>
                        <th scope="row">CIF</th>
                        <td>{{ $empresa->cif }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Nom empresa</th>
                        <td>{{ $empresa->name }}</td>
                    </tr>
                    <tr>
                        <th>Sector</th>
                        <td>{{ $empresa->sector }}</td>
                    </tr>
                    <tr>
                        <th>Comarca</th>
                        <td>{{ $poblacio->comarca->name }}</td>
                    </tr>
                    <tr>
                        <th>Poblacio</th>
                        <td>{{ $poblacio->name }}</td>
                    </tr>
                </table>
            </div>
            <div class="contactes">
                <div class="list-header">
                    <div id="contactes">Contactes</div>
                    <div class="filtro"><button class="filtrar" data-bs-toggle="modal" data-bs-target="#newContact">Crear Contacte</button></div>
                </div>
                <table id="contactes-table" class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th scope="col"><span>Nom</span></th>
                            <th scope="col"><span>Correu Electrònic</span></th>
                            <th scope="col"><span>Telèfon</span></th>
                        </tr>
                    </thead>
                    <tbody id="contactes-info">
                        @foreach($contactes as $contacte)
                        <tr>
                            <th scope="row"><a href="{{ route('contacte_detail', $contacte->id) }}">{{ $contacte->name }}</a></th>
                            <td><a href="{{ route('contacte_detail', $contacte->id) }}">{{ $contacte->email }}</a></td>
                            <td><a href="{{ route('contacte_detail', $contacte->id) }}">{{ $contacte->phonenumber }}</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="estades">
        <div class="list-header">
            <div id="estades">Estades</div>
            <div class="filtro"><button class="filtrar" data-bs-toggle="modal" data-bs-target="#newEstada">Crear Estada</button></div>
        </div>
        <table id="estades-table" class="table table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col"><span>Alumne</span></th>
                    <th scope="col"><span>Curs</span></th>
                    <th scope="col"><span>Cicle</span></th>
                    <th scope="col"><span>Tutor</span></th>
                    <th scope="col"><span>Tipus estada</span></th>
                    <th scope="col"><span>Valoració</span></th>
                </tr>
            </thead>
            <tbody id="estades-info">
                @foreach($estades as $estada)
                <tr>
                    <th><a href="{{ route('estada_detail', $estada->id) }}">{{ $estada->student_name }}</a></th>
                    <td><a href="{{ route('estada_detail', $estada->id) }}">{{ $estada->curs->name }}</a></td>
                    <td><a href="{{ route('estada_detail', $estada->id) }}">{{ $estada->cicle->shortname }}</a></td>
                    <td><a href="{{ route('estada_detail', $estada->id) }}">{{ $estada->tutor() }}</a></td>
                    <td>
                        <a href="{{ route('estada_detail', $estada->id) }}">
                            @if ($estada->dual == true)
                            Dual
                            @else
                            FTC
                            @endif
                        </a>
                    </td>
                    <td><a href="{{ route('estada_detail', $estada->id) }}">{{ $estada->evaluation }}</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
<div class="modal fade" id="editInfo" tabindex="-1" aria-labelledby="editInfoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editInfoLabel">Editar empresa</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" name="editEmpresaForm" action="{{ route('empresa_edit', $empresa->id) }}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="cif">CIF</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="cif" placeholder="Ex: A-00000000" value="{{ $empresa->cif }}" required/>
                        </div>
                        <div id="cif-edit-empresa-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="name">Nom</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="name" value="{{ $empresa->name }}" required/>
                        </div>
                        <div class="error" id="name-edit-empresa-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="sector">Sector</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="sector" value="{{ $empresa->sector }}" required/>
                        </div>
                        <div class="error" id="sector-edit-empresa-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="comarca_id">Comarca</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-select" name="comarca_id" id="comarca_id" value="{{ $poblacio->comarca_id }}">
                                @foreach($comarques as $comarca)
                                @if ( $comarca->id == $poblacio->comarca_id )
                                <option value="{{ $comarca->id }}" selected>{{ $comarca->name }}</option>
                                @else
                                <option value="{{ $comarca->id }}">{{ $comarca->name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="error" id="comarca_id-edit-empresa-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="poblacio_id">Població</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-select" id="poblacio_id" name="poblacio_id" value="{{ $empresa->poblacio_id }}">
                                <option value="default">Selecciona una comarca...</option>
                            </select>
                        </div>
                        <div class="error" id="poblacio_id-edit-empresa-error"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="newContact" tabindex="-1" aria-labelledby="newContactLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newContactLabel">Crear un contacte</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" name="addContacteForm" action="{{ route('contacte_new') }}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="name">Nom</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="name" />
                        </div>
                        <div class="error" id="name-add-contacte-error"></div>
                    </div>
                    <input type="hidden" name="empresa_id" value="{{ $empresa->id }}"/>
                    <div id="empresa_id-add-contacte-error"></div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="email">Email</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="email" />
                        </div>
                        <div class="error" id="email-add-contacte-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="phonenumber">Telèfon</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="phonenumber" />
                        </div>
                        <div class="error" id="phonenumber-add-contacte-error"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
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
                            <label class="col-form-label" for="student_name">Nom Estudiant</label>
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
                            <label class="col-form-label" for="registered_by">Registrado por</label>
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
                    <input type="hidden" name="empresa_id" value="{{ $empresa->id }}" />
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="dual">Tipus estada</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-select" type="text" name="dual">
                                <option value="default">Selecciona un tipus d'estada...</option>
                                <option value="0">FCT</option>
                                <option value="1">Dual</option>
                            </select>
                        </div>
                        <div class="error" id="dual-add-estada-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="evaluation">Evaluation</label>
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
                            <input class="form-control" type="text" name="comment" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/empresa_detail_poblacions_json.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/validators.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/empresa_edit_validator.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/contacte_add_validator.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/estada_add_validator.js') }}"></script>
<br>
@endsection