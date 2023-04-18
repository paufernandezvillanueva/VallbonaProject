@extends('layout')

@section('title', 'Llistat d\'empresas')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/empresaDetail.css') }}" />
    @parent
@endsection

@section('content')
<div class="titulo">
    <h1>{{ $empresa->name }}</h1>
</div>
<!-- <a href="{{ route('empresa_new') }}">+ Nova empresa</a> -->
<div class="containerEmpresa">
    <div>
        <div class="labels">
            <div class="infoEmpresa">
                <div class="list-header">
                    <div id="info">Info empresa</div>
                    <div class="filtro"><button class="filtrar" data-bs-toggle="modal" data-bs-target="#editInfo">Editar Informacio</button></div>
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
                            <th scope="col"><span>Correu Electronic</span></th>
                            <th scope="col"><span>Telefon</span></th>
                            <th scope="col"></th>
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
                        <th scope="col"><span>Valoracio</span></th>
                        <th scope="col"></th>
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('empresa_edit', $empresa->id) }}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="cif">CIF</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="cif" value="{{ $empresa->cif }}"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="name">Nom</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="name" value="{{ $empresa->name }}"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="sector">Sector</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="sector" value="{{ $empresa->sector }}"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="comarca_id">Comarca</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-control" id="comarca_id" value="{{ $poblacio->comarca_id }}">
                                <option>Carregant...</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="poblacio_id">Població</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-control" id="poblacio_id" name="poblacio_id" value="{{ $empresa->poblacio_id }}">
                                <option>Selecciona una comarca...</option>
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
<div class="modal fade" id="newContact" tabindex="-1" aria-labelledby="newContactLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newContactLabel">Crear un contacte</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('contacte_new') }}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="name">Nom</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="name" />
                        </div>
                    </div>
                    <input type="hidden" name="empresa_id" value="{{ $empresa->id }}"/>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="email">Email</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="email" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="phonenumber">Telefon</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="phonenumber" />
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
                            <input class="form-control" type="text" name="student_name"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="curs_id">Curs</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-control" type="text" name="curs_id">
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
                            <select class="form-control" type="text" name="cicle_id">
                                <option>Selecciona un cicle...</option>
                                @foreach($cicles as $cicle)
                                    <option value="{{ $cicle->id }}">{{ $cicle->shortname }} - {{ $cicle->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="registered_by">Registrado por</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-control" type="text" name="registered_by">
                                <option>Selecciona un tutor...</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="empresa_id" value="{{ $empresa->id }}"/>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="dual">Tipus estada</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-control" type="text" name="dual">
                                <option>Selecciona un tipus d'estada...</option>
                                <option value="0">FTP</option>
                                <option value="1">Dual</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="evaluation">Evaluation</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="number" min="0" max="10" value="5" name="evaluation"/>
                        </div>
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
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/empresa_poblacions_json.js') }}"></script>
<br>
@endsection