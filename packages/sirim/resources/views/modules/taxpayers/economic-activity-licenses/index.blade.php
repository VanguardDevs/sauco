@extends('layouts.template')

@section('title', 'Licencias del contribuyente '.$taxpayer->rif)

@section('content')

@if(Auth()->user()->can('create.licenses'))
<div class="col-md-12">
    @if($requirement==null)
    <div class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-paper"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Emitir licencia 
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            {!! Form::open(['route' => ['economic-activity-license.create', $taxpayer->id], 'autocomplete' => 'off', 'enctype' => 'multipart/form-data',]) !!}
                <div class="form-group row">
                    <div class="col-lg-8">
                        {!!
                            Form::select('correlative', $correlatives, null, [
                                'class' => 'col-md-12 select2'
                            ])
                        !!}
                    </div>
                    <div class="col-lg-4">
                        <button class="btn btn-success" type="submit">
                            Enviar
                        </button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    @else
    <div class="alert alert-warning alert-dismissible" role="alert">
            <strong>¡Debe pagar la sanción para generar una nueva licencia!</strong> {{ session('error') }}
        </div>

    @endif
</div>
@endif
<div class="col-xl-12">
    <div class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__body">
            <table id="tEconomicActivityLicensesTaxpayer" class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                  <tr>
                    <th width="40%">Número</th>
                    <th width="40%">Fecha de emisión</th>
                    <th width="20%">Acciones</th>
                  </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
