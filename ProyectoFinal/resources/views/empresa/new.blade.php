@extends('layout')

@section('title', 'Nou Empresa')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Nova Empresa</h1>
    <a href="{{ route('empresa_list') }}">&laquo; Torna</a>
	<div style="margin-top: 20px">
        <form method="POST" action="{{ route('empresa_new') }}">
            @csrf
            <div>
                <label for="cif">CIF</label>
                <input type="text" name="cif"/>
            </div>
            <div>
                <label for="name">Nom</label>
                <input type="text" name="name"/>
            </div>
            <div>
                <label for="sector">Sector</label>
                <input type="text" name="sector"/>
            </div>
            <div>
                <label for="poblacio_id">Població</label>
                <input type="text" name="poblacio_id"/>
            </div>
            <button type="submit">Crear Empresa</button>
        </form>
	</div>
@endsection