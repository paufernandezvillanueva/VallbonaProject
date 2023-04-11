@extends('layout')

@section('title', 'Editar Comarca')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Editar Comarca</h1>
    <a href="{{ route('comarca_list') }}">&laquo; Torna</a>
	<div style="margin-top: 20px">
        <form method="POST" action="{{ route('comarca_edit', ['id' => $comarca->id]) }}">
            @csrf
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ $comarca->name }}" />
            </div>
            <div>
                <label for="comarca_id">Comarca</label>
                <select name="comarca_id">
                    <option value="">-- selecciona una comarca --</option>
                    @foreach ($comarcas as $comarca)
                        <option value="{{ $comarca->id }}" @selected($comarca->comarca_id == $comarca->id)>{{ $comarca->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit">Desar</button>
        </form>
	</div>
@endsection
