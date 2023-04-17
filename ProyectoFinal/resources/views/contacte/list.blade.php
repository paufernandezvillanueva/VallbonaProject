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

@section('title', 'Llistat de contactes')

@section('stylesheets')
@parent
@endsection

@section('content')
<div class="titulo">
    <h1>Llista de contactes</h1>
</div>
<div class="modal fade" id="nouContacte" tabindex="-1" aria-labelledby="nouContacteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="width: 100%; text-align: center;" id="nouContacteLabel">Afegir contacte</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('contacte_new') }}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label text-dark" for="name">Name</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="name" />
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
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label text-dark" for="email">Email</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="email" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label text-dark" for="phonenumber">Telefon</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="phonenumber" />
                        </div>
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
            <th scope="col">Nom</th>
            <th scope="col">Empresa</th>
            <th scope="col">Email</th>
            <th scope="col">Telefon</th>
            <th><a href="#" id="btnAfegirContacte" data-bs-toggle="modal" data-bs-target="#nouContacte">Nou contacte</a></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($contactes as $contacte)
        <tr>
            <th scope="row">{{ $contacte->name }}</th>
            <td>{{ $contacte->empresa->name }}</td>
            <td>{{ $contacte->email }}</td>
            <td>{{ $contacte->phonenumber }}</td>
            <td>
                <a href="{{ route('contacte_delete', ['id' => $contacte->id]) }}" id="icon-basura"><i class="bi bi-trash3-fill"></i></a>
                <a href="{{ route('contacte_edit', ['id' => $contacte->id]) }}">Editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
<br>
@endsection
