@extends('layout')

@section('title', 'Llistat de comarcas')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="titulo">
        <h1>Llistat de comarcas</h1>
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
                    <th>Nom</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($comarcas as $comarca)
                    <tr>
                        <td>{{ $comarca->name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    <br>
@endsection
