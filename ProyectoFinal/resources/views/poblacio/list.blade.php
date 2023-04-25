@extends('layout')

@section('title', 'Llistat de poblacions')

@section('stylesheets')
@parent
<link rel="stylesheet" href="{{ asset('css/poblacioList.css') }}" />
@endsection

@section('content')
<div class="titulo">
    <h1>Llistat de poblacions</h1>
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
    <form id="filter-form" class="filter-form filter-form-closed-base" action="{{ route('poblacio_list') }}">
        <div id="filter-form-container">
            <div>
            <label for="name">Nom: 
                @if (isset($request->name) && $request->name != "")
                   <input type="text" id="name" name="name" value="{{ $request->name }}"></input>
                @else
                    <input type="text" id="name" name="name"></input>
                @endif
            </label><br>
            </div>
            <div>
            <label for="name">Comarca: 
                @if (isset($request->comarca) && $request->comarca != "")
                   <input type="text" id="comarca" name="comarca" value="{{ $request->comarca }}"></input>
                @else
                    <input type="text" id="comarca" name="comarca"></input>
                @endif
            </label><br>
            </div>
        </div>
        <div id="filter-form-button"><input type="submit" value="Filtrar"></div>
    </form>
</div>

<table id="poblacio-table" class="table table-striped table-dark">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Comarca</th>
            <th>
                <a class="iconAdd" data-bs-toggle="modal" data-bs-target="#novaPoblacio">
                    <i class="bi bi-plus-square-fill"></i>
                </a>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($poblacions as $poblacio)
        <tr>
            <td><a href="{{ route('poblacio_detail', $poblacio->id) }}">{{ $poblacio->name }}</a></td>
            <td>
                <form action="{{ route('poblacio_list') }}" method="GET">
                    <input type="hidden" name="comarca" value="{{ $poblacio->comarca->name }}" />
                    <a href="#" onclick="this.parentNode.submit()">{{ $poblacio->comarca->name }}</a>
                </form>
            </td>
            <td>
                <a data-id="{{ $poblacio->id }}" class="iconBasura" data-bs-toggle="modal" data-bs-target="#confirmDelete">
                    <i class="bi bi-trash3-fill"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


<div class="modal fade" id="novaPoblacio" tabindex="-1" aria-labelledby="novaPoblacioLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPoblacioLabel">Crear una Poblacio</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('poblacio_new') }}">
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
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="comarca_id">Comarca</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-control" name="comarca_id">
                                <option>Selecciona una comarca...</option>
                                @foreach($comarques as $comarca)
                                <option value="{{ $comarca->id }}">{{ $comarca->name }}</option>
                                @endforeach
                            </select>
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
<div class="modal fade" id="confirmDelete" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">Eliminar població</h5>
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
                                console.log(form.action);
                            });
                        });
                    </script>
                    @csrf
                    <p>Estàs segur de voler eliminar aquest usuari?</p>
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
<br>
@endsection