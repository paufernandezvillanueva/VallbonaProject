@extends('layout')

@section('title', 'Nova Poblacio')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Nova Poblacio</h1>
    <a href="{{ route('poblacio_list') }}">&laquo; Torna</a>
	<div style="margin-top: 20px">
        <form method="POST" name="form" action="{{ route('poblacio_new') }}">
            @csrf
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" />
            </div>
            <div>
                <label for="comarca_id">Autor</label>
                <select name="comarca_id">
                    <option value="">-- selecciona una comarca --</option>
                    @foreach ($comarques as $comarca)
                        <option value="{{ $comarca->id }}">{{ $comarca->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" name="submit">Crear Poblacio</button>
        </form>
	</div>
@endsection