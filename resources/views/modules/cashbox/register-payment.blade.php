@extends('cruds.form')

@section('title', 'Factura n° '.$row->id)

@section('form')
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header alert alert-danger">
            @if ($typeForm == 'edit')
            <h5 class="card-title">Procesar factura n° {{ $row->id }}</h5>
            @else
            <h5 class="card-title">Factura n° {{ $row->id }}</h5>
            @endif
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        @if ($typeForm == 'edit')
            {!! Form::model($row, ['route' => ["payments".'.update', $row->id], 'method' => 'patch', 'autocomplete' => 'off', 'role' => 'form', 'enctype' => 'multipart/form-data',]) !!}
        @endif
        <div class="card-body">
          <table class="table table-bordered table-striped datatables" style="text-align: center">
            <thead>
              <tr>
                <th width="10%">ID</th>
                <th width="80%">Objecto de Pago</th>
                <th width="10%">Monto</th>
              </tr>
            </thead>
            <tbody>
            @foreach($row->receivables as $receivable)
             <tr>
                <td>{{ $receivable->id }}</td> 
                <td>{{ $receivable->object_payment  }}</td>   
                <td>{{ $receivable->settlement->amount }}</td>
            </tr>
            @endforeach   
          </table>
        @if ($typeForm == 'edit')        
        <div class="row form-group">
            <div class="col-md-6 form-group">
                <label class="control-label"> Método de pago <span class="text-danger">*</span></label>

                {!! Form::select('method', $methods,
                    (isset($row->economicSector) ? ($row->economicSector->id) : null), [
                    'class' => 'form-control select2',
                    'placeholder' => ' SELECCIONE ',
                    'id' => 'payment_methods',
                    'required'
                ]) !!}
            </div>
            <div class="col-md-6 form-group">
                <label class="control-label"> Tipo de pago <span class="text-danger">*</span></label>

                {!! Form::select('type', $types,
                    (isset($row->economicSector) ? ($row->economicSector->id) : null), [
                    'class' => 'form-control select2',
                    'placeholder' => ' SELECCIONE ',
                    'required'
                ]) !!}
            </div>
            <div class="col-md-12 form-group" id="reference" style="display:none;">
                <div class="col-md-12">
                    <label class="control-label">Referencia del pago</label>
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
