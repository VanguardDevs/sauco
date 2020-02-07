@extends('cruds.form')

@section('title', 'Aprobar licencia 2020')

@section('form')
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head alert alert-danger">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Aprobación de licencia num {{ $row->num }}

                            {{-- @section('breadcrumbs')
                                {{ Breadcrumbs::render('settings/economic-sectors/create') }}
                            @endsection --}}
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->
                @if ($typeForm == 'old-license')
                    {!! Form::open(['route' => ["old-license-renew", $row->id, $taxpayer->id], 'class' => 'kt-form kt-form--label-right', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
                @endif
                    <div class="kt-portlet__body">
                        @if ((isset($taxpayer->commercialRegister)) && (isset($taxpayer->representation)) && (isset($taxpayer->economicActivities)))
                        <div class="kt-heading kt-heading--md">
                            Datos generales del contribuyente:
                        </div>
                        <div class="form-group row">
                            <div class="form-group col-md-6">
                                <label class="control-label">Nombre (Razón Social)<span class="text-danger">*</span></label>
                                {!!
                                Form::text("name", old('name', @$taxpayer->name), ['class' => 'form-control', 'disabled'])
                                !!}
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">RIF<span class="text-danger">*</span></label>
                                {!!
                                Form::text("name", old('name', @$taxpayer->rif), ['class' => 'form-control', 'disabled'])
                                !!}
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">Dirección fiscal<span class="text-danger">*</span></label>
                                {!!
                                Form::text("name", old('name', @$taxpayer->fiscal_address), ['class' => 'form-control', 'disabled'])
                                !!}
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">Nombre del representante<span class="text-danger">*</span></label>
                                {!!
                                Form::text("name", old('name', @$taxpayer->representation->name), ['class' => 'form-control', 'disabled'])
                                !!}
                            </div>

                            <div class="kt-separator kt-separator--border-solid kt-separator--portlet-fit kt-separator--space-lg"></div>

                            <div class="col-lg-3">
                                <label>Nro. de liquidación<span class="text-danger">*</span></label>

                                {!! Form::text('settlement', old('settlement', @$row->settlement), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('settlement')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label>Nro. de liquidación<span class="text-danger">*</span></label>

                                {!! Form::text('settlement', old('settlement', @$row->settlement), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('settlement')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label>Nro. de liquidación<span class="text-danger">*</span></label>

                                {!! Form::text('settlement', old('settlement', @$row->settlement), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('settlement')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label>Nro. de liquidación<span class="text-danger">*</span></label>

                                {!! Form::text('settlement', old('settlement', @$row->settlement), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('settlement')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label>Nro. de liquidación<span class="text-danger">*</span></label>

                                {!! Form::text('settlement', old('settlement', @$row->settlement), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('settlement')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label>Nro. de liquidación<span class="text-danger">*</span></label>

                                {!! Form::text('settlement', old('settlement', @$row->settlement), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('settlement')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label>Nro. de liquidación<span class="text-danger">*</span></label>

                                {!! Form::text('settlement', old('settlement', @$row->settlement), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('settlement')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label>Nro. de liquidación<span class="text-danger">*</span></label>

                                {!! Form::text('settlement', old('settlement', @$row->settlement), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('settlement')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label>Nro. de liquidación<span class="text-danger">*</span></label>

                                {!! Form::text('settlement', old('settlement', @$row->settlement), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('settlement')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label>Nro. de liquidación<span class="text-danger">*</span></label>

                                {!! Form::text('settlement', old('settlement', @$row->settlement), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('settlement')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label>Nro. de liquidación<span class="text-danger">*</span></label>

                                {!! Form::text('settlement', old('settlement', @$row->settlement), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('settlement')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label>Nro. de liquidación<span class="text-danger">*</span></label>

                                {!! Form::text('settlement', old('settlement', @$row->settlement), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('settlement')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            @else
                                <div class="kt-heading kt-heading--md">
                                    ¡Este contribuyente no se encuentra debidamente registrado!
                                </div>
                            @endif

                        </div>
                    </div>

                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="{{ url('applications') }}" class="btn btn-secondary" id="cancel"><i class="fas fa-reply"></i> Regresar</a>
                                    <button type="submit" class="btn btn-primary" id="send">
                                        <i class="fas fa-save"></i>
                                        Registrar
                                    </button>
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
