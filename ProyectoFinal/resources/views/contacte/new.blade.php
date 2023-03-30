@extends('layout')

@section('title', 'Nou Contacte')

@section('stylesheets')
@parent
@endsection

@section('content')
<h1>Nou Contacte</h1>
<a href="{{ route('contacte_list') }}">&laquo; Torna</a>
<div style="margin-top: 20px">
    <form method="POST" action="{{ route('contacte_new') }}">
        @csrf
        <div>
            <label for="name">Nom</label>
            <input type="text" name="name" />
        </div>
        <div>
            <label for="empresa">Empresa</label>
            <input type="text" name="email" />
        </div>
        <div>
            <label for="email">Email</label>
            <input type="text" name="email" />
        </div>
        <div>
            <label for="phonenumber">Telefon</label>
            <input type="text" name="phonenumber" />
        </div>
        <button type="submit">Crear Contacte</button>
    </form>
</div>
@endsection