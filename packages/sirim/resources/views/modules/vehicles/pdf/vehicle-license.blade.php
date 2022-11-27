<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            body {
                font-family: 'Helvetica';
                font-size: 15px;
            }
            .header {
                width: 100%;
                font-size: 8.5px;
                position: relative;
                display: block;
            }
            .header div {
                display: inline-block;
            }
            #mayorLOGO {
                float: right;
                margin-top: -10px;
            }
            table, td, th {
                border: 1px #000 solid;
            }
            td {
                font-size: 11.5px;
                padding: 2px 1px;
            }
            table {
                border-collapse: collapse;
                margin-top: -10px;
                width:95%;
                align: center;
                text-align: center;
            }
            .details td, h4 {
                text-align: center;
            }
            .details .object-payment {
                text-align: left;
                padding-left: 3px;
            }
            .tables {
                display:block;
                border-color: red;
                border-width: 1.5px;
                border-style: solid;
                margin-top: -6px;
            }
            .bill-info {
                width: 100%;
                clear: both;
                font-weight: bold;
            }
            .col-bill-info {
                float: left;
                width: 50%;
                font-size: 16px;
            }
            .total-amount {
                text-align: right;
            }
            .miscellaneus {
                font-size: 12px;
            }
            caption {
                font-weight: bold;
            }
            th {
                font-size: 10px;
                padding: 3px 1px;
            }
            .row {
                display: block;
                padding-left: 10px;
            }
            .text-center {
                text-align: center;
            }
            .bottom {
                width: 95%;
                height: 130px;
                text-transform: uppercase;
                font-weight: 700;
                font-size: 11px;
                margin: auto;
                margin-top: 7%;
                margin-bottom: -8%;
            }
            .center {
                margin-left: auto;
                margin-right: auto;
            }        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <div class="sumatLOGO">
                    <img src="{{ asset('/assets/images/logo_sumat.png') }}" height="89px" width="230px" alt="sumatlogo"/>

                </div>
                <div class="description text-center">
                <p>
                    REPÚBLICA BOLIVARIANA DE VENEZUELA<br>
                    ESTADO SUCRE<br>
                    ALCALDÍA DEL MUNICIPIO BERMÚDEZ<br>
                    SUPERINTENDENCIA MUNICIPAL DE ADMINISTRACIÓN TRIBUTARIA<br>
                    RIF: G-20000292-1<br>
                    DIRECCIÓN: AV. CARABOBO, EDIFICIO MUNICIPAL
                    </p>
                </div>
                <div id="mayorLOGO">
                    <img src="{{ asset('/assets/images/logo_alcaldia.jpg') }}" height="79px" width="130px" alt="logo" />
                </div>
            </div>

            <div class="tables">
                <h4 style="margin-top: 1px;" >PATENTE DE VEHÍCULO</h4>
            <table class="center">
                <thead>
                    <tr>
                        <th colspan="2" style="font-size: 12px; padding: 2px 1px;"><strong>REGISTRO</strong> {{ $license->num }} DE FECHA {{ $license->emission_date }}</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td width="85%"><strong>CONTRIBUYENTE:</strong> {{ $license->taxpayer->name }}</td>
                        <td width="15%"><strong>RIF: </strong>{{ $license->taxpayer->rif }}</td>
                    </tr>
                    <tr>
                        <td><strong>REPRESENTANTE LEGAL:</strong> {{ $representation->name }}</td>
                        <td><strong>C.I:</strong> {{ $representation->document }}</td>
                  </tr>
                  <tr>
                    <td colspan="2"><strong>DIRECCIÓN:</strong> {{ $license->taxpayer->fiscal_address }}</td>
                  </tr>
                  <tr>
                    <td >
                    <strong>TIPO:</strong> {{ $vehicle->vehicleClassification->vehicleParameter->name  }}
                    </td>
                    <td >
                        <strong>CLASIFICACIÓN:</strong> {{ $vehicle->vehicleClassification->name }}
                    </td>
                  </tr>

                    <tr width="100%">
                        <td colspan="1" width="50%">
                            <strong>MARCA:</strong> {{ $vehicle->vehicleModel->brand->name }}
                        </td>
                        <td colspan="1" width="50%">

                            <strong>MODELO:</strong> {{ $vehicle->vehicleModel->name }}
                        </td>
                    </tr>
                    <tr width="100%">
                        <td colspan="1" >
                            <strong>COLOR:</strong> {{ $vehicle->color->name }}
                        </td>
                        <td colspan="1" >
                            <strong>PLACA:</strong> {{ $vehicle->plate }}
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2"><strong>PERIODO DE VIGENCIA:</strong> {{ $period }}</td>
                    </tr>

                </tbody>
            </table>
            <div>

                <div class="bottom text-center" style="z-index: -1;">
                    <span class="row">{{ $signature->title }}</span>
                    <span class="row">superintendente de administración tributaria</span>
                    <span class="row">RESOLUCIÓN Nº 357 DE FECHA 30-11-2021. GACETA MUNICIPAL EXTRAORDINARIA Nº 378 DE FECHA 30-11-2021</span>

                    @if($paymentNum)
                        <span class="row">Correspondiente al Registro {{ $license->num }} de Fecha {{$license->emission_date }} Tasa Administrativa pagada en fecha {{ $processedAt }} con Factura Nº {{ $paymentNum }}</span>
                    @else
                        <span class="row">Correspondiente al Registro {{ $license->num }} de Fecha {{$license->emission_date }}</span>
                    @endif
                    @if($license->correlative->correlative_type_id == 1)
                        <span class="row" style="font-size: 8px">REFERENCIA: Registro de Patente de Vehículo</span>
                    @else
                        <span class="row" style="font-size: 8px">REFERENCIA: Renovación de Patente de Vehículo</span>
                    @endif
                    
                </div>
            </div>
			<div class="bandera" >
                    <img src="{{ asset('/assets/images/bandera.png') }}" height="35px" width="99.9%" alt="bandera"/>
             </div>

        </div>

        </div>
    </body>
</html>
