@extends('layout')

@section('title', 'Editar Contacte')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Editar Contacte</h1>
<a href="{{ route('contacte_list') }}">&laquo; Torna</a>
<div style="margin-top: 20px">
<form method="POST" action="{{ route('contacte_edit', ['id' => $contacte->id]) }}">
        @csrf
        <div>
            <label for="name">Nom</label>
            <input type="text" name="name" value="{{ $contacte->name }}"/>
        </div>
        <div>
            <label for="empresa_id">Empresa</label>
            <input type="text" name="empresa_id" value="{{ $contacte->empresa_id }}"/>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="text" name="email" value="{{ $contacte->email }}"/>
        </div>
        <div>
            <label for="phonenumber">Telefon</label>
            <input type="text" name="phonenumber" value="{{ $contacte->phonenumber }}"/>
        </div>
        <button type="submit">Crear Contacte</button>
    </form>
</div>
@endsection