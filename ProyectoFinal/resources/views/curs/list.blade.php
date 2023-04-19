@extends('layout')

@section('title', 'Llistat de cursos')

@section('stylesheets')
@parent
@endsection

@section('content')
<div class="titulo">
    <h1>Llista de cursos</h1>
</div>
<div class="modal fade" id="nouCurs" tabindex="-1" aria-labelledby="nouCursLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="width: 100%; text-align: center;" id="nouCursLabel">Afegir curs</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('curs_new') }}">
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
<div class="table-responsive" style=" height: 80vh; width: 60vh; margin: auto ">
    <table class="table table-striped table-dark " style="margin-top: 20px;margin-bottom: 10px; -webkit-overflow-scrolling: auto">
    <thead>
        <tr>
            <th scope="col">Nom</th>
            <th><a href="#" id="btnAfegirCurs" data-bs-toggle="modal" data-bs-target="#nouCurs">Nou curs</a></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cursos as $curs)
        <tr>
            <th scope="row">{{ $curs->name }}</th>
            <td>
                <a href="{{ route('curs_delete', ['id' => $curs->id]) }}" id="icon-basura"><i class="bi bi-trash3-fill"></i></a>
                <a href="{{ route('curs_edit', ['id' => $curs->id]) }}">Editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
<br>
@endsection
