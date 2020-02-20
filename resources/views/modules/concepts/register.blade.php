@extends('cruds.form')

@section('title', 'Registro de Concepto de Recaudación')

@section('form')
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head alert alert-danger">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                        @if ($typeForm == 'create')
                            Registro de Concepto de Recaudación

                            @section('breadcrumbs')
                                {{ Breadcrumbs::render('settings/concepts/create') }}
                            @endsection
                        @else
                            Editar usuario: {{ @$row->login }}

                            @section('breadcrumbs')
                                {{ Breadcrumbs::render('settings/concepts/edit', $row) }}
                            @endsection
                        @endif
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->
                @if ($typeForm == 'create')
                    {!! Form::open(['route' => "concepts".'.store', 'class' => 'kt-form kt-form--label-right', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
                @else
                    {!! Form::model($row, ['route' => ["concepts".'.update', $row->id], 'method' => 'patch', 'autocomplete' => 'off', 'class' => 'kt-form kt-form--label-right', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
                @endif
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label>Código <span class="text-danger">*</span></label>

                                {!! Form::text('code', old('description', @$row->code), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('code')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-10">
                                <label>Nombre del concepto <span class="text-danger">*</span></label>

                                {!! Form::text('name', old('description', @$row->description), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('name')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Tipo de ordenanza<span class="text-danger">*</span></label>

                                {!! Form::select('ordinance', $ordinances,
                                    (isset($row->ordinance) ? ($row->ordinance->id) : null), [
                                    'class' => 'col-md-12 form-control select2',
                                    'placeholder' => ' SELECCIONE ',
                                    "required"
                                ]) !!}

                                @error('ordinance')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label>Incluir en el listado <span class="text-danger">*</span></label>

                                {!! Form::select('list', $listings,
                                    (isset($row->listing) ? ($row->listing->id) : null), [
                                    'class' => 'col-md-12 form-control select2',
                                    'placeholder' => ' SELECCIONE ',
                                    "required"
                                ]) !!}

                                @error('list')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Método de cobro</label>
                                {!! Form::select('charging_method', $chargingMethods,
                                    (isset($row->chargingMethod) ? ($row->chargingMethod->id) : null), [
                                    'class' => 'col-md-12 form-control select2',
                                    'placeholder' => ' SELECCIONE ',
                                ]) !!}

                                @error('charging_method')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                           <div class="col-lg-6">
                                <label>Valor</label>

                                {!! Form::text('value', old('value', @$row->value), ['class' => 'form-control decimal-input-mask']) !!}

                                @error('value')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <label>Ley, ordenanza o decreto <span class="text-danger">*</span></label>

                                {!! Form::text('law', old('law', @$row->law), ['class' => 'form-control'])!!}

                                @error('law')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                    </div>

                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="{{ url('settings/concepts') }}" class="btn btn-secondary" id="cancel"><i class="fas fa-reply"></i> Regresar</a>

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
