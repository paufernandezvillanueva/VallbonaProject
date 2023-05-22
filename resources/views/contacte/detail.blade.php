@extends('layout')

@section('title', $contacte->name)

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/contacteDetail.css') }}" />
@parent
@endsection

@section('content')
<div class="titulo">
    <h1>{{ $contacte->name }}</h1>
</div>
<div class="containerContacte">
    <div>
        <div class="btnTorna">
            <a href="{{ route('contacte_list') }}"><i class="bi bi-arrow-left-circle-fill"></i> {{ trans('translation.back') }}</a>
        </div>
        <div class="labels">
            <div class="infoContacte">
                <div class="list-header">
                    <div id="info">{{ trans('translation.info') }}</div>
                    <div class="filtro"><button class="filtrar" data-bs-toggle="modal" data-bs-target="#editInfo">{{ trans('translation.edit') }}</button></div>
                </div>
                <table id="info-table" class="table table-striped table-dark">
                    <tr>
                        <th scope="row">{{ trans('translation.name') }}</th>
                        <td>{{ $contacte->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('translation.company') }}</th>
                        <td>{{ $contacte->empresa->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('translation.email') }}</th>
                        <td>{{ $contacte->email }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('translation.phone') }}</th>
                        <td>{{ $contacte->phonenumber }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editInfo" tabindex="-1" aria-labelledby="editInfoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editInfoLabel">{{ trans('translation.edit') }} {{ trans('translation.contact') }}</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>
            <form method="POST" name="editContacteForm" action="{{ route('contacte_edit', $contacte->id) }}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="name">{{ trans('translation.name') }}</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="name" value="{{ $contacte->name }}"  />
                        </div>
                        <div class="error" id="name-edit-contacte-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="empresa_id">{{ trans('translation.company') }}</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <select class="form-select" name="empresa_id" value="{{ $contacte->empresa_id }}">
                                @foreach($empresas as $empresa)
                                @if ($empresa->id == $contacte->empresa_id)
                                <option value="{{ $empresa->id }}" selected>{{ $empresa->name }}</option>
                                @else
                                <option value="{{ $empresa->id }}">{{ $empresa->name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="error" id="empresa_id-edit-contacte-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="email">{{ trans('translation.email') }}</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="email" value="{{ $contacte->email }}" />
                        </div>
                        <div class="error" id="email-edit-contacte-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <label class="col-form-label" for="phonenumber">{{ trans('translation.phone') }}</label>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <input class="form-control" type="text" name="phonenumber" value="{{ $contacte->phonenumber }}" />
                        </div>
                        <div class="error" id="phonenumber-edit-contacte-error"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ trans('translation.cancel') }}</button>
                    <button type="submit" class="btn btn-secondary">{{ trans('translation.confirm') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<datalist id="empresas">
    @foreach($empresas as $empresa)
        <option value="{{ $empresa->name }}">
    @endforeach
</datalist>

<script type="text/javascript" src="{{ asset('js/validators.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/contacte_edit_validator.js') }}"></script>
<br>
@endsection
