@extends('layouts.template')

@section('title', 'Licencias del contribuyente '.$taxpayer->rif)

@section('content')

@if(Auth()->user()->can('create.licenses'))
<div class="col-md-12">

    @if($requirement)
    <div class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-paper"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Emitir licencia de expendios
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            {!! Form::open(['route' => ['liqueur-license.create', $taxpayer->id], 'autocomplete' => 'off', 'enctype' => 'multipart/form-data',]) !!}
                <div class="form-group row">
                    <div class="col-lg-12">
                        <br><br>
                    </div>
                    <div class="col-lg-12" id= "new_license">
                        @include('modules.taxpayers.liqueur-licenses.forms.installation')
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12">
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
            <strong>¡Debe realizar y pagar la solicitud para una nueva licencia!</strong> {{ session('error') }}
        </div>

    @endif
</div>
@endif
<div class="col-xl-12">
    <div class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__body">
            <table id="tLiqueurLicensesTaxpayer" class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                  <tr>
                    <th width="40%">Número</th>
                    <th width="20%">Fecha de emisión</th>
                    <th width="20%">Estado</th>
                    <th width="20%">Acciones</th>
                  </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
