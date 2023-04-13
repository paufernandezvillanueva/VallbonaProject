@extends('layout')

@section('title', 'Llistat de poblacions')

@section('stylesheets')
    @parent
@endsection

@section('content')

    <div class="titulo">
        <h1>Llistat de poblacions</h1>
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
                <th>Nom</th>
                <th>Comarca</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($poblacions as $poblacio)
                <tr>
                    <td>{{ $poblacio->name }}</td>
                    <td>{{ $poblacio->comarca->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <br>
@endsection
