@extends('cruds.form')

@section('title', 'Factura '.$row->num)

@section('form')
    <!-- general form elements -->
    <div class="kt-portlet">
        <!-- /.card-header -->
        <!-- form start -->
        @if ($typeForm == 'update')
            {!! Form::model($row, ['route' => ["liquidations".'.update', $row->id], 'method' => 'put', 'autocomplete' => 'off', 'role' => 'form', 'enctype' => 'multipart/form-data',]) !!}
        @endif
        <div class="kt-portlet__body">
           <div class="form-group col-lg-12">
                <div class="kt-heading kt-heading--md">
                    Datos generales del contribuyente
                </div>
           </div>

            <table class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                    <tr>
                    <th width="20%">RIF</th>
                    <th width="40%">Nombre</th>
                    <th width="40%">Dirección</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $taxpayer->rif }}</td>
                        <td>{{ $taxpayer->name  }}</td>
                        <td>{{ $taxpayer->fiscal_address }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="row">
                <div class="form-group col-lg-6">
                    <div class="kt-heading kt-heading--md">
                        Información de la liquidación
                        </br>

                        Tipo: <strong>{{ $row->liquidationType->name }}</strong>
                        </br>Monto: <strong>{{ $row->pretty_amount }}</strong>
                        </br>Fecha: <strong>{{ $row->created_at }}</strong>
                        </br>Usuario: <strong>{{ $row->liquidable->user->full_name }}</strong>
                    </div>
                </div>
                @if($typeForm == 'update')
                <div class="form-group col-lg-6">
                    <div class="kt-heading kt-heading--md">
                        Realizar retención </br>
                        <label class="control-label col-md-12 col-md-4">
                            Ingrese el monto a retener <span class="text-danger">*</span>
                        </label>
                        {!!
                            Form::text("withholding_amount", null, [
                                "class" => "form-control col-md-12 col-md-6 decimal-input-mask",
                                "required" => true
                            ])
                        !!}
                    </div>

                    @error('withholding_amount')
                    <div class="text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                @endif
            </div>

            <!-- /.card-body -->
            <div class="card-footer">
                @if($typeForm == 'update')
                    <a href="{{ URL::previous() }}" class="btn btn-danger" id="cancel">
                        <i class="flaticon-cancel"></i>
                        Cancelar
                    </a>
                    <button
                        type="submit"
                        class="btn btn-warning"
                        onClick="this.form.submit(); this.disabled=true;"
                    >
                        <i class="fas fa-save"></i>
                        Registrar retención
                    </button>
                @else
                    <a href="{{ URL::previous() }}" class="btn btn-secondary" id="cancel">
                        <i class="fas fa-reply"></i>
                        Regresar
                    </a>
                @endif

                @if($row->liquidation_type_id == 3)
                <a href="{{ route('affidavits.show', $row->liquidable()->first() ) }}"}} class='btn btn-success' title='Ir a la declaración'>
                    <i class='fas fa-chevron-right'></i>
                    Ir a la declaración
                </a>
                @endif
                <a href="{{ route('payments.show', $row->payment()->first()) }}"}} class='btn btn-info' title='Ir al pago'>
                    <i class="fas fa-money-check"></i> Ver factura
                </a>
            </div>
        {!! Form::close() !!}
    </div>
    <!-- /.card -->
@endsection
