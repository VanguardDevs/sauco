@extends('cruds.form')

@section('title', 'Registro de Actividad Económica')

@section('form')
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head alert alert-danger">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                        @if ($typeForm == 'create')
                            Registro de Actividad Económica

                            @section('breadcrumbs')
                                {{ Breadcrumbs::render('economic-activities/create') }}
                            @endsection
                        @else
                            Editar actividad económica: {{ @$row->login }}

                            @section('breadcrumbs')
                                {{ Breadcrumbs::render('economic-activities/edit', $row) }}
                            @endsection
                        @endif
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->
                @if ($typeForm == 'create')
                    {!! Form::open(['route' => "economic-activities".'.store', 'class' => 'kt-form kt-form--label-right', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
                @else
                    {!! Form::model($row, ['route' => ["economic-activities".'.update', $row->id], 'method' => 'patch', 'autocomplete' => 'off', 'class' => 'kt-form kt-form--label-right', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
                @endif
                    <div class="kt-portlet__body">
                        <div class="form-group row">

                            @if ($typeForm == 'create')
                            <div class="col-lg-3">
                                <label>Código <span class="text-danger">*</span></label>

                                {!! Form::text('code', null, ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('code')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-9">
                            @else
                            <div class="col-lg-12">
                            @endif
                                <label> Nombre <span class="text-danger">*</span></label>

                                {!! Form::text('name', old('name', @$row->name), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('name')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label> Alícuota <span class="text-danger">*</span></label>

                                {!! Form::text('aliquote', old('aliquote', @$row->aliquote), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('aliquote')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label> Mínimo Tributable <span class="text-danger">*</span></label>

                                {!! Form::text('min_tax', old('min_tax', @$row->min_tax), ['class' => 'form-control', "onkeyup" => "upperCase(this);", "required"]) !!}

                                @error('min_tax')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="{{ url('economic-activities') }}" class="btn btn-secondary" id="cancel"><i class="fas fa-reply"></i> Regresar</a>

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
