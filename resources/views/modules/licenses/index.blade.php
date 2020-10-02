@extends('layouts.template')

@section('title', 'Patentes')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="kt-portlet">
             <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand fas fa-file-medical"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Patentes emitidas
                    </h3>
                </div>
           </div>
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <div class="col-lg-5">
                        <label class="col-lg-12">Seleccione el tipo de licencia<span class="text-danger"> *</span></label>
                        {!!
                            Form::select('types', $types, null, [
                                'class' => 'col-md-12 select2',
                                'placeholder' => 'SELECCIONE',
                                'id' => 'types',
                                'required' 
                            ])
                        !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="kt-portlet">
           <div class="kt-portlet__body">
              <table id="tLicenses" class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                    <tr>
                        <th width="15%">Número</th>
                        <th width="15%">RIF</th>
                        <th width="40%">Razón social</th>
                        <th width="15%">Ordenanza</th>
                        <th width="10%">Fecha</th>
                        <th width="5%">Acciones</th>
                    </tr>
                </thead>
            </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="{{ asset('js/licenses.js') }}"></script>
@endpush
