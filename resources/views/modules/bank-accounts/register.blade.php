@extends('cruds.form')

@section('title', 'Registro de Cuentas Bancarias')

@section('form')
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head alert alert-danger">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                        @if ($typeForm == 'create')
                            Registro de Cuentas Bancarias

                            @section('breadcrumbs')
                                {{ Breadcrumbs::render('settings/bank-accounts/create') }}
                            @endsection
                        @else
                            Editar usuario: {{ @$row->login }}

                            @section('breadcrumbs')
                                {{ Breadcrumbs::render('settings/bank-accounts/edit', $row) }}
                            @endsection
                        @endif
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->
                @if ($typeForm == 'create')
                    {!! Form::open(['route' => "bank-accounts".'.store', 'class' => 'kt-form kt-form--label-right', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
                @else
                    {!! Form::model($row, ['route' => ["bank-accounts".'.update', $row->id], 'method' => 'patch', 'autocomplete' => 'off', 'class' => 'kt-form kt-form--label-right', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
                @endif
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Nombre del Banco<span class="text-danger">*</span></label>

                                {!! Form::text('bank_name', old('bank_name', @$row->bank), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('bank_name')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label>Número de cuenta <span class="text-danger">*</span></label>

                                {!! Form::text('account_num', old('account_num', @$row->account_num), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('account_num')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label>Tipo de cuenta <span class="text-danger">*</span></label>

                                <select name="account_type" class="form-control">
                                    <option value="">===== SELECCIONE =====</option>
                                    @foreach ($accountTypes as $type)
                                        <option value="{{ $type->id }}" @if(old('accountType') == $type->id OR @$row->type->id == $type->id) selected @endif >
                                        {{ $type->denomination }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('account_type')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label>Descripción <span class="text-danger">*</span></label>

                                {!! Form::text('description', old('description', @$row->description), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('description')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="{{ url('administration/users') }}" class="btn btn-secondary" id="cancel"><i class="fas fa-reply"></i> Regresar</a>

                                    @if($typeForm == 'update')
                                        <button type="submit" class="btn btn-primary" id="send">
                                                <i class="flaticon-refresh"></i>
                                                Actualizar
                                        </button>
                                    @else
                                        <button type="submit" class="btn btn-primary" id="send">
                                            <i class="fas fa-save"></i>
                                            Registrar
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
      <!--end::Form-->
        </div>
    <!--end::Portlet-->
    </div>
@endsection
