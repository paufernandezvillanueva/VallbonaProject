@extends('layout')

@section('title', $estada->student_name)

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/estadaDetail.css') }}" />
@parent
@endsection

@section('content')
<div class="titulo">
    <h1>{{ $estada->student_name }}</h1>
</div>
<div class="containerEstada">
    <div>
        <div class="btnTorna">
            <a href="{{ route('estada_list') }}"><i class="bi bi-arrow-left-circle-fill"></i> {{ trans('translation.back') }}</a>
        </div>
        <div class="labels">
            <div class="infoEstada">
                <div class="list-header">
                    <div id="info">{{ trans('translation.info')  }}</div>
                    <div class="filtro"><button class="filtrar" data-bs-toggle="modal" data-bs-target="#editInfo">{{ trans('translation.edit') }}</button></div>
                </div>
                <table id="info-table" class="table table-striped table-dark">
                    <tr>
                        <th scope="row">{{ trans('translation.name_student') }}</th>
                        <td>{{ $estada->student_name }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('translation.course') }}</th>
                        <td>{{ $estada->curs->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('translation.cicle') }}</th>
                        <td>{{ $estada->cicle->shortname }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('translation.tutor') }}</th>
                        <td>{{ $estada->tutor() }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('translation.stay_type') }}</th>
                        <td>
                            @if ($estada->dual == true)
                                Dual
                            @else
                                FCT
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>{{ trans('translation.company') }}</th>
                        <td>{{ $estada->empresa->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('translation.valoration') }}</th>
                        <td>{{ $estada->evaluation }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('translation.comment') }}</th>
                        <td>{{ $estada->comment }}</td>
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
                <h5 class="modal-title" id="editInfoLabel">{{ trans('translation.edit_stay') }}</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>
            <form method="POST" name="editEstadaForm" action="{{ route('estada_edit', $estada->id) }}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-2 col-12">
                            <label class="col-form-label" id="student_name" for="student_name">{{ trans('translation.name_student') }}</label>
                        </div>
                        <div class="col-md-10 col-12">
                            <input class="form-control" type="text" name="student_name" value="{{ $estada->student_name }}" />
                        </div>
                        <div class="error" id="student_name-edit-estada-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-12">
                            <label class="col-form-label" for="curs_id">{{ trans('translation.course') }}</label>
                        </div>
                        <div class="col-md-10 col-12">
                            <select class="form-select" name="curs_id">
                                @foreach($cursos as $curs)
                                    @if ($curs->id == $estada->curs_id)
                                        <option value="{{ $curs->id }}" selected>{{ $curs->name }}</option>
                                    @else
                                        <option value="{{ $curs->id }}">{{ $curs->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="error" id="curs_id-edit-estada-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-12">
                            <label class="col-form-label" for="cicle_id">{{ trans('translation.cicle') }}</label>
                        </div>
                        <div class="col-md-10 col-12">
                            <select class="form-select" name="cicle_id">
                                @foreach($cicles as $cicle)
                                    @if ($cicle->id == $estada->cicle_id)
                                        <option value="{{ $cicle->id }}" selected>{{ $cicle->shortname }}</option>
                                    @else
                                        <option value="{{ $cicle->id }}">{{ $cicle->shortname }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="error" id="cicle_id-edit-estada-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-12">
                            <label class="col-form-label" for="registered_by">{{ trans('translation.registered_by') }}</label>
                        </div>
                        <div class="col-md-10 col-12">
                            <select class="form-select" name="registered_by">
                                @foreach($users as $user)
                                    @if ($user->id == $estada->registered_by)
                                        <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                    @else
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="error" id="registered_by-edit-estada-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-12">
                            <label class="col-form-label"for="dual">{{ trans('translation.stay_type') }}</label>
                        </div>
                        <div class="col-md-10 col-12">
                            <select class="form-select" name="dual">
                                @if ($estada->dual == 1)
                                    <option value="0">FCT</option>
                                    <option value="1" selected>Dual</option>
                                @else
                                    <option value="0" selected>FCT</option>
                                    <option value="1">Dual</option>
                                @endif
                            </select>
                        </div>
                        <div class="error" id="dual-edit-estada-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-12">
                            <label class="col-form-label" for="empresa_id">{{ trans('translation.company') }}</label>
                        </div>
                        <div class="col-md-10 col-12">
                            <select class="form-select" name="empresa_id">
                                @foreach($empresas as $empresa)
                                    @if ($empresa->id == $estada->empresa_id)
                                        <option value="{{ $empresa->id }}" selected>{{ $empresa->name }}</option>
                                    @else
                                        <option value="{{ $empresa->id }}">{{ $empresa->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="error" id="empresa_id-edit-estada-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-12">
                            <label class="col-form-label" for="evaluation">{{ trans('translation.valoration') }}</label>
                        </div>
                        <div class="col-md-10 col-12">
                            <input class="form-control" type="number" name="evaluation" value="{{ $estada->evaluation }}" min="0" max="10" />
                        </div>
                        <div class="error" id="evaluation-edit-estada-error"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-12">
                            <label class="col-form-label" for="comment">{{ trans('translation.comment') }}</label>
                        </div>
                        <div class="col-md-10 col-12">
                            <textarea class="form-control" name="comment">{{ $estada->comment }}</textarea>
                        </div>
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
<script type="text/javascript" src="{{ asset('js/validators.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/estada_edit_validator.js') }}"></script>
@endsection
