@extends('cruds.form')

@section('title', 'Factura # '.$row->num)

@section('form')
    <!-- general form elements -->
    <div class="kt-portlet">
        <!-- /.card-header -->
        <!-- form start -->
        @if ($typeForm == 'edit')
            {!! Form::model($row, ['route' => ["payments".'.update', $row->id], 'method' => 'patch', 'autocomplete' => 'off', 'role' => 'form', 'enctype' => 'multipart/form-data',]) !!}
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
                <th width="10%">RIF</th>
                <th width="45%">Nombre</th>
                <th width="45%">Dirección</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $row->taxpayer->rif }}</td> 
                    <td>{{ $row->taxpayer->name  }}</td>   
                    <td>{{ $row->taxpayer->fiscal_address }}</td>
                </tr>
            </tbody>
          </table>

           <div class="form-group col-lg-12">
                <div class="kt-heading kt-heading--md">
                    Detalles del cobro
                </div>
           </div>

          <table class="table table-bordered table-striped datatables" style="text-align: center">
            <thead>
              <tr>
                <th width="10%">Liquidación</th>
                <th width="80%">Concepto</th>
                <th width="10%">Monto</th>
              </tr>
            </thead>
            <tbody>
            @foreach($row->settlements as $settlement)
             <tr>
                <td>{{ $settlement->num }}</td> 
                <td>{{ $settlement->object_payment  }}</td>   
                <td>{{ $settlement->total_amount }}</td>
            </tr>
            @endforeach   
          </table>
           <div class="form-group col-lg-12">
                <div class="kt-heading kt-heading--md">
                    Monto Total: {{ $row->amount }} Bs
                </div>
                @if ($typeForm == 'show')
                <div class="kt-heading kt-heading--md">
                    Liquidador: {{ $row->user->fullName }}
                </div>
                <div class="kt-heading kt-heading--md">
                    Método de pago: {{ $row->paymentMethod->name }}
                </div>
                @endif
           </div>
        @if ($typeForm == 'edit')        
        <div class="row form-group">
            <div class="col-md-12 form-group">

                <label class="control-label"> Método de pago <span class="text-danger">*</span></label>

                {!! Form::select('method', $methods,
                    (isset($row->economicSector) ? ($row->economicSector->id) : null), [
                    'class' => 'form-control select2',
                    'placeholder' => ' SELECCIONE ',
                    'id' => 'payment_methods',
                    'required'
                ]) !!}
            </div>
            <div class="col-md-12 form-group" id="reference" style="display:none;">
                <div class="col-md-12">
                    <label class="control-label">Referencia del pago <span class="text-danger">*</span></label>
                    {!!
                    Form::text("reference", old('trade_denomination', @$row->denomination), [
                        "class" => "form-control"
                    ])
                    !!}
                </div>
            </div>
            <div class="col-md-12 form-group">
                <label class="control-label"> Observaciones </label>

                {!!
                    Form::text("observations", old('trade_denomination', @$row->denomination), [
                        "class" => "form-control",
                        "onkeyup" => "upperCase(this);"
                    ])
                !!}
            </div>
        </div>
        @endif
        <!-- /.card-body -->
        <div class="card-footer">
            @if($typeForm == 'edit')
            <a href="{{ url('cashbox/payments') }}" class="btn btn-danger" id="cancel"><i class="flaticon-cancel"></i>Cancelar</a>
                <button  type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Registrar
                </button>
            @else
            <a href="{{ URL::previous() }}" class="btn btn-secondary" id="cancel"><i class="fas fa-reply"></i>Regresar</a>
            @if($typeForm == 'show' && Auth::user()->can('process.payments'))
            <a href="{{ route('payments.download', $row->id ) }}"}} class='btn btn-success' title='Descargar factura' target='_blank'>
                <i class='flaticon2-download'></i>
                Imprimir factura
            </a>
            @endif
        @endif
        </div>
        {!! Form::close() !!}
    </div>
    <!-- /.card -->
@endsection
