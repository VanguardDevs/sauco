@extends('layouts.template')

@section('title', 'Inicio')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <!--begin:: Widgets/Activity-->
        <div class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay kt-portlet--skin-solid kt-portlet--height-fluid">
            <div class="kt-portlet__head kt-portlet__head--noborder kt-portlet__space-x">
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-widget17">
                    <div class="kt-widget17__visual kt-widget17__visual--chart kt-portlet-fit--top kt-portlet-fit--sides" style="background-color: #D4AF37">
                        <div class="kt-widget17__chart" style="height:320px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <div style="text-align:center; color:aliceblue">
                                <h3>Sistema de Recaudación de Impuestos Municipales</h3>
                            </div>
                        </div>
                    </div>
                    <div class="kt-widget17__stats">
                    </div>
                </div>
            </div>
        </div>
        <!--end:: Widgets/Activity-->
    </div>
</div>
@endsection
