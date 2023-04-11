@extends('layout')

@section('title', 'Editar Estada')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Editar Estada</h1>
<a href="{{ route('estada_list') }}">&laquo; Torna</a>
<div style="margin-top: 20px">
    <form method="POST" action="{{ route('estada_new') }}">
        @csrf
        <div>
            <label for="cicle_id">Cicle ID</label>
            <input type="text" name="cicle_id" value="{{ $estada->cicle_id }}"/>
        </div>
        <div>
            <label for="empresa_id">Empresa ID</label>
            <input type="text" name="empresa_id" value="{{ $estada->empresa_id }}"/>
        </div>
        <div>
            <label for="evaluation">Evaluation</label>
            <input type="number" min="0" max="10" name="evaluation" value="{{ $estada->evaluation }}"/>
        </div>
        <div>
            <label for="comment">Comentaris</label>
            <input type="text" name="comment" value="{{ $estada->comment }}"/>
        </div>
        <div>
            <label for="dual">Dual</label>
            <input type="text" name="dual" value="{{ $estada->dual }}"/>
        </div>
        <div>
            <label for="registered_by">Registrado por</label>
            <input type="text" name="registered_by" value="{{ $estada->registered_by }}"/>
        </div>
        <div>
            <label for="curs_id">Curs ID</label>
            <input type="text" name="curs_id" value="{{ $estada->curs_id }}"/>
        </div>
        <button type="submit">Crear Estada</button>
    </form>
</div>
@endsection