@extends('layout')

@section('title', 'Editar Empresa')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Editar Empresa</h1>
    <a href="{{ route('empresa_list') }}">&laquo; Torna</a>
	<div style="margin-top: 20px">
        <form method="POST" action="{{ route('empresa_edit', ['id' => $empresa->id]) }}">
            @csrf
            <div>
                <label for="cif">CIF</label>
                <input type="text" name="cif" value="{{ $empresa->cif }}"/>
            </div>
            <div>
                <label for="name">Nom</label>
                <input type="text" name="name" value="{{ $empresa->name }}"/>
            </div>
            <div>
                <label for="sector">Sector</label>
                <input type="text" name="sector" value="{{ $empresa->sector }}"/>
            </div>
            <!-- <div>
                <label for="comarca_id">Comarca</label>
                <input type="text" name="comarca_id" value="{{ $empresa->comarca_id }}"/>
            </div> -->
            <div>
                <label for="poblacio_id">Població</label>
                <input type="text" name="poblacio_id" value="{{ $empresa->poblacio_id }}"/>
            </div>
            <button type="submit">Editar Empresa</button>
        </form>
	</div>
@endsection
