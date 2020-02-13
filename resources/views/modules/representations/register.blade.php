@extends('cruds.form')

@section('title', 'Registro de representantes')

@section('form')
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head alert alert-danger">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                        @if ($typeForm == 'create')
                            Registro de representantes

                            @section('breadcrumbs')
                                {{ Breadcrumbs::render('settings/economic-sectors/create') }}
                            @endsection
                        @endif
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->
                @if ($typeForm == 'create')
                    {!! Form::open(['url' => route('representation.store', [$taxpayer->id]), 'class' => 'kt-form kt-form--label-right', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
                @else
                    {!! Form::model($row, ['route' => ["representation".'.update', $row->id], 'method' => 'patch', 'autocomplete' => 'off', 'class' => 'kt-form kt-form--label-right', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
                @endif
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label>Nacionalidad <span class="text-danger">*</span></label>

                                {!!
                                    Form::select('citizenship', $citizenships, null, [
                                    'class'=>'form-control select2',
                                    'placeholder' => ' SELECCIONE ',
                                    'id' => 'citizenships'
                                    ])
                                !!}

                                @error('citizenship')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label>Cédula de identidad <span class="text-danger">*</span></label>

                                {!! Form::text('document', old('document', @$row->document), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('document')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label>Tipo de representante<span class="text-danger">*</span></label>

                                {!!
                                    Form::select('representation_type', $representationTypes, null, [
                                    'class'=>'form-control select2',
                                    'placeholder' => ' SELECCIONE ',
                                    ])
                                !!}

                                @error('representation_type')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="{{ url('settings/economic-sectors') }}" class="btn btn-secondary" id="cancel"><i class="fas fa-reply"></i> Regresar</a>

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
