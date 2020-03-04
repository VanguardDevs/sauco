@extends('cruds.form')

@section('title', 'Factura n° '.$row->num)

@section('form')
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header alert alert-danger">
            @if ($typeForm == 'edit')
            <h5 class="card-title">Procesar factura n° {{ $row->num }}</h5>
            @else
            <h5 class="card-title">factura n° {{ $row->num }}</h5>
            @endif
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        @if ($typeForm == 'edit')
            {!! Form::model($row, ['route' => ["payments".'.update', $row->id], 'method' => 'patch', 'autocomplete' => 'off', 'role' => 'form', 'enctype' => 'multipart/form-data',]) !!}
        @endif
        <div class="card-body">
           <div class="form-group col-lg-12">
                <div class="kt-heading kt-heading--md">
                    Datos generales del contribuyente
                </div>
           </div>
 
          <table class="table table-bordered table-striped datatables" style="text-align: center">
            <thead>
              <tr>
                <th width="10%">rif</th>
                <th width="45%">nombre</th>
                <th width="45%">dirección</th>
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

           <div class="form-group col-lg-12">
                <div class="kt-heading kt-heading--md">
                    Detalles del cobro
                </div>
           </div>

          <table class="table table-bordered table-striped datatables" style="text-align: center">
            <thead>
              <tr>
                <th width="10%">id</th>
                <th width="80%">detalle(s) del pago</th>
                <th width="10%">monto</th>
              </tr>
            </thead>
            <tbody>
            @foreach($row->receivables as $receivable)
             <tr>
                <td>{{ $receivable->settlement->numFormat }}</td> 
                <td>{{ $receivable->object_payment  }}</td>   
                <td>{{ $receivable->settlement->amountFormat }}</td>
            </tr>
            @endforeach   
          </table>
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
            <a href="{{ url('cashbox/payments') }}" class="btn btn-secondary" id="cancel"><i class="fas fa-reply"></i>Regresar</a>
            @endif
        </div>
        {!! Form::close() !!}
    </div>
    <!-- /.card -->
@endsection
