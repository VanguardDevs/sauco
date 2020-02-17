@extends('cruds.form')

@section('title', 'Registro de Inmueble')

@section('form')
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head alert alert-danger">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                        @if ($typeForm == 'create')
                            Registro de Firma Personal 

                            @section('breadcrumbs')
                                {{ Breadcrumbs::render('properties/create') }}
                            @endsection
                        @else
                            Editar usuario: {{ @$row->login }}

                            @section('breadcrumbs')
                                {{ Breadcrumbs::render('properties/edit', $row) }}
                            @endsection
                        @endif
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->
                @if ($typeForm == 'create')
                    {!! Form::open(['route' => ["add-property", $taxpayer->id], 'class' => 'kt-form kt-form--label-right', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
                @else
                    {!! Form::model($row, ['route' => ["add-property".'.update', $row->id], 'method' => 'patch', 'autocomplete' => 'off', 'class' => 'kt-form kt-form--label-right', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
                @endif
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="control-label"> Firma personal <span class="text-danger">*</span></label>
                                {!! Form::number("firm", old('firm', @$row->firm),
                                [
                                    "Placeholder" => "Firma",
                                    "class" => "form-control",
                                ]) !!}
                                @error('firm')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="control-label"> Cargo <span class="text-danger">*</span></label>
                                {!! Form::text("chargue", old('chargue', @$row->chargue'),
                                [
                                    "placeholder" => "Cargo",
                                    "class" => "form-control decimal-input-mask"
                                ]) !!}
                                @error('chargue')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="control-label"> Resolución <span class="text-danger">*</span></label>
                                {!! Form::text("resolution_num", old('resolution_num', @$row->resolution_num),
                                [
                                    "Placeholder" => "Resolución",
                                    "class" => "form-control",
                                    "onkeyup" => "upperCase(this);"
                                ]) !!}
                                @error('resolution_num')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group col-md-6">
                                <label class="control-label"> Fecha de resolución <span class="text-danger">*</span></label>

                                {!! Form::text("resolution_date", old('resolution_date', @$row->resolution_date),
                                [
                                    "Placeholder" => "Resolución",
                                    "class" => "form-control",
                                    "onkeyup" => "upperCase(this);"
                                ]) !!}

                                @error('resolution_date')
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
