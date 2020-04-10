@extends('layouts.template')

@section('subheader__title', 'Cuentas por cobrar')

@section('title', 'Cuentas por cobrar')

@section('content')
<div class="row">
    <div class="col-md-4 col-sm-12">
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__body">
                <div class="kt-widget4">
                    <a href="{{ Route('economic-activity-licenses.index') }}" class="kt-widget4__item">
                        <div class="kt-widget4__icon">
                            <i class="flaticon2-medical-records"></i>
                        </div>
                        <div class="kt-widget4__title kt-widget4__title--dark">
                            <div class="kt-notification__item-title">
                                Solicitudes
                            </div>
                            <small>
                            </small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-12">
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__body">
                <div class="kt-widget4">
                    <a href="{{ Route('representations.index') }}" class="kt-widget4__item">
                        <div class="kt-widget4__icon">
                            <i class="flaticon-users-1"></i>
                        </div>
                        <div class="kt-widget4__title kt-widget4__title--dark">
                            <div class="kt-notification__item-title">
                                Multas
                            </div>
                            <small>
                            </small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
      <div class="kt-portlet">
        <div class="kt-portlet__body">
          <table id="tReceivables" class="table table-bordered table-striped datatables" style="text-align: center">
            <thead>
              <tr>
                <th width="10%">ID</th>
                <th width="10%">RIF</th>
                <th width="50%">Razón social</th>
                <th width="10%">Monto</th>
                <th width="10%">Acciones</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
</div>

@endsection
