@extends('cruds.form')

@if ($typeForm == 'create')
    @section('title', 'Nuevo concepto de recaudación')
    @section('subheader__title', 'Nuevo concepto de recaudación')
@else
    @section('title', 'Actualización de concepto de recaudación')
    @section('subheader__title', 'Actualización concepto de recaudación')
@endif

@section('form')
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet">
                <!-- form start -->
                @if ($typeForm == 'create')
                {!! Form::open(['route' => 'concepts'.'.store', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data',]) !!}
                @else
                {!! Form::model($row, ['route' => ['concepts'.'.update', $row->id], 'method' => 'patch', 'autocomplete' => 'off', 'role' => 'form', 'enctype' => 'multipart/form-data',]) !!}
                @endif
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label"> Cuenta contable <span class="text-danger">*</span></label>

                            {!! Form::select('accounting_account_id', $accounts,
                                (isset($row->accounting_account) ? ($row->accounting_account->id) : null), [
                                'class' => 'form-control select2',
                                'placeholder' => ' SELECCIONE ',
                                'required'
                            ]) !!}

                            @error('accounting_account_id')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"> Ordenanza <span class="text-danger">*</span></label>

                            {!! Form::select('ordinance_id', $ordinances,
                                (isset($row->ordinance) ? ($row->ordinance->id) : null), [
                                'class' => 'form-control select2',
                                'placeholder' => ' SELECCIONE ',
                                'required'
                            ]) !!}

                            @error('ordinance_id')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"> Tipo de liquidación <span class="text-danger">*</span></label>

                            {!! Form::select('liquidation_type_id', $types,
                                (isset($row->liquidation_type) ? ($row->liquidation_type->id) : null), [
                                'class' => 'form-control select2',
                                'placeholder' => ' SELECCIONE ',
                                'required'
                            ]) !!}

                            @error('liquidation_type_id')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <label class="control-label">Nombre<span class="text-danger">*</span></label>
                            {!!
                            Form::text("name", old('name', @$row->name), [
                                "Placeholder" => "Nombre del nuevo concepto",
                                "class" => "form-control",
                                "onkeyup" => "upperCase(this);"
                            ])
                            !!}

                            @error('name')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label"> Método de cálculo <span class="text-danger">*</span></label>

                            {!!
                                Form::select('charging_method_id', $chargingMethods,
                                    null, [
                                    'class'=>'col-md-12 form-control select2',
                                    'placeholder' => ' SELECCIONE ',
                                    'id' => 'communities',
                                    'required'
                                ])
                            !!}

                            @error('charging_method_id')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Valor mínimo <span class="text-danger">*</span></label>

                            {!! Form::text('min_amount', old('value', @$row->value), ['class' => 'form-control decimal-input-mask']) !!}

                            @error('min_amount')
                                <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Valor máximo</label>

                            {!! Form::text('max_amount', old('value', @$row->value), ['class' => 'form-control decimal-input-mask']) !!}
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary" id="cancel"><i class="fas fa-reply"></i> Regresar</a>

                    @if($typeForm == 'edit')
                    <button type="submit" class="btn btn-primary">
                        <i class="flaticon2-reload"></i>
                        Actualizar
                    </button>
                    @else
                    <button  type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Registrar
                    </button>
                    @endif
                </div>
                {!! Form::close() !!}
                <!-- end:: Content -->
                </div>
        </div>
    </div>
@endsection
