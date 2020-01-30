@extends('cruds.form')

@section('title', 'Registro de Ordenanzas')

@section('form')
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head alert alert-danger">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                        @if ($typeForm == 'create')
                            Registro de Ordenanzas

                            @section('breadcrumbs')
                                {{ Breadcrumbs::render('settings/ordinances/create') }}
                            @endsection
                        @else
                            Editar usuario: {{ @$row->login }}

                            @section('breadcrumbs')
                                {{ Breadcrumbs::render('settings/ordinances/edit', $row) }}
                            @endsection
                        @endif
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->
                @if ($typeForm == 'create')
                    {!! Form::open(['route' => "ordinances".'.store', 'class' => 'kt-form kt-form--label-right', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
                @else
                    {!! Form::model($row, ['route' => ["ordinances".'.update', $row->id], 'method' => 'patch', 'autocomplete' => 'off', 'class' => 'kt-form kt-form--label-right', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
                @endif
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Descripción<span class="text-danger">*</span></label>

                                {!! Form::text('description', old('description', @$row->description), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('description')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Tipo de ordenanza<span class="text-danger">*</span></label>

                                {!! Form::select('ordinance_type', $ordinanceTypes, null, [
                                    'class' => 'col-md-12 form-control select2',
                                    'placeholder' => ' SELECCIONE ',
                                    "required"
                                ]) !!}

                                @error('ordinance_type')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label>Método de cobro</label>

                                {!! Form::select('charging_method', $chargingMethods, null, [
                                    'class' => 'col-md-12 form-control select2',
                                    'placeholder' => ' SELECCIONE ',
                                    "required"
                                ]) !!}

                                @error('charging_method')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label>Ley<span class="text-danger">*</span></label>

                                {!! Form::text('law', old('law', @$row->law), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('law')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label>Valor <span class="text-danger">*</span></label>

                                {!! Form::text('value', old('value', @$row->value), ['class' => 'form-control decimal-input-mask', "required"]) !!}

                                @error('value')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label>Fecha de publicación <span class="text-danger">*</span></label>

                                {!! Form::text('publication_date', old('publication_date', @$row->publication_date), ['class' => 'form-control date-input-mask', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('publication_date')
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
