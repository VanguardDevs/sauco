@extends('cruds.form')

@section('title', 'Añadir registro mercantil')

@section('form')
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head alert alert-danger">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                        @if ($typeForm == 'create')
                            Añadir registro mercantil

                            @section('breadcrumbs')
                                {{ Breadcrumbs::render('commercial-registers/create') }}
                            @endsection
                        @else
                            Editar registro comercial: {{ @$row->login }}

                            @section('breadcrumbs')
                                {{ Breadcrumbs::render('settings/commercial-registers/edit', $row) }}
                            @endsection
                        @endif
                        </h3>
                    </div>
                </div>
                <!--begin::Form-->
                @if ($typeForm == 'create')
                    {!! Form::open(['route' => ["add-commercial-register", $taxpayer->id], 'class' => 'kt-form kt-form--label-right', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
                @else
                    {!! Form::model($row, ['route' => ["add-commercial-register".'.update', $row->id], 'method' => 'patch', 'autocomplete' => 'off', 'class' => 'kt-form kt-form--label-right', 'enctype' => 'multipart/form-data', 'id' => 'form']) !!}
                @endif
                    <div class="kt-portlet__body">
                            <div class="form-group col-md-12">
                                <label class="control-label"> Número <span class="text-danger">*</span></label>
                                {!! Form::text("num", old('num', @$row->num), [
                                    "Placeholder" => "Número del registro comercial",
                                    "class" => "form-control",
                                    "onkeyup" => "upperCase(this);"
                                ]) !!}
                                @error('num')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label"> Tomo <span class="text-danger">*</span></label>
                                {!! Form::text("volume", old('volume', @$row->volume), [
                                "Placeholder" => "Tomo del registro comercial",
                                "class" => "form-control"
                                ]) !!}
                                @error('volume')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label"> Expediente <span class="text-danger">*</span></label>
                                {!! Form::text(
                                "case_file",
                                old('case_file',
                                @$row->case_file
                                ), [
                                "Placeholder" => "Expediente",
                                "class" => "form-control",
                                "onkeyup" => "upperCase(this);"
                                ]) !!}

                                @error('case_file')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Fecha de inicio de actividades <span class="text-danger">*</span></label>
                                {!! Form::text(
                                "start_date",
                                old('start_date', @$row->start_date),
                                [
                                "class" => "form-control date-input-mask",
                                "placeholder" => "DD/MM/AAAA"
                                ])
                                !!}

                                <span class="form-text text-muted">Formato de fecha:
                                <code>DD/MM/AAAA</code>
                                </span>
                                @error('start_date')
                                <div class="text text-danger">{{ $message }}</div>
                                @enderror
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
