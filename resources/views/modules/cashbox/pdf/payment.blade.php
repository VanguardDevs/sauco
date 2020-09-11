<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!-- CSRF Token -->
        <title> Factura </title>
        <style>
           body {
                font-family: sans-serif, serif;
                font-size: 15px;
            }
            .header {
                width: 100%;
                font-size: 9px;
                position: relative;
                display: block;
            }
            .header div {
                display: inline-block;
            }
            #mayorLOGO {
                float: right;
            }
            table, td, th {
                border: 1px #000 dashed;
            }
            td {
                font-size: 13px;
                padding: 2px;
            }
            table {
                border-collapse: collapse;
                width: 100%;                
                margin-top: 5px;
            }
            .tables {
                display:block;
            }
            .bill-info {
                width: 100%;
                clear: both;
                font-weight: bold;
            }
            .col-bill-info {
                float: left;
                width: 50%;
                font-size: 15px;
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
            }
        </style>
    </head>

    <body>
        <div class="header">
            <div class="sumatLOGO">
                <img src="{{ base_path().'/public/assets/images/sumat.png' }}" height="90px" width="230px" alt="sumatlogo"/>
            </div>
            <div class="description">
               <p>
                REPÚBLICA BOLIVARIANA DE VENEZUELA<br>
                ESTADO SUCRE<br>
                ALCALDÍA DEL MUNICIPIO BERMÚDEZ<br>
                SUPERINTENDENCIA MUNICIPAL DE ADMINISTRACIÓN TRIBUTARIA<br>
                RIF: G-20000222-1<br>
                DIRECCIÓN: AV. CARABOBO, EDIFICIO MUNICIPAL
                </p>
            </div>
            <div id="mayorLOGO">
                <img src="{{ base_path().'/public/assets/images/logo.png' }}" height="70px" width="130px" alt="logo" />
            </div>
        </div>
        <div class="tables">
            <table class="table" style="text-align: center;margin-bottom:0;">
                <thead>
                  <tr>
                    <th width="85%">RAZÓN SOCIAL O DENOMINACIÓN COMERCIAL</th>
                    <th width="15%">RIF</th>
                  </tr>
                </thead>
                <tbody>
                     <tr>
                        <td>{{ $denomination }}</td> 
                        <td>{{ $payment->taxpayer->rif }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table" style="text-align: center;margin-top:0;border-top:none;">
                <thead>
                  <tr>
                    <th width="100%">DIRECCIÓN FISCAL</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $payment->taxpayer->fiscal_address }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table" style="text-align: center">
                <caption>OBJETO DE PAGO</caption>
                <thead>
                  <tr>
                    <th width="20%">FECHA</th>
                    <th width="65%">FORMA DE PAGO</th>
                    <th width="15%">REFERENCIA</th>
                  </tr>
                </thead>
                <tbody>
                     <tr>
                        <td>{{ $payment->processed_at }}</td> 
                        <td>{{ $payment->paymentMethod->name }}</td>   
                        <td>{{ $payment->reference->reference ?? 'S/N' }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="" style="text-align: center">
                <caption>DETALLES DEL PAGO</caption>
                <thead>
                  <tr>
                    <th width="20%">LIQUIDACIÓN</th>
                    <th width="60%">DETALLES</th>
                    <th width="20%">MONTO TOTAL</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($payment->liquidations as $liquidation)
                 <tr>
                    <td>{{ $liquidation->num }}</td> 
                    <td>{{ $liquidation->object_payment  }}</td>   
                    <td style="font-weight:bold;">{{ $liquidation->total_amount }}</td>
                </tr>
                @endforeach   
             </table>
        </div>
        <br>
        <div class="bill-info">
            <div class="col-bill-info">
                N° DE FACTURA: {{ $payment->num }}
            </div>
            <div class="col-bill-info">
                <div class="total-amount">
                    PAGO TOTAL: {{ $payment->formattedAmount }} Bs
                </div>
            </div>
        </div>
        <br>
        <div class="miscellaneus">
            <div class="liquidator-info">
                Recaudador: {{ $payment->user->first_name.' '.$payment->user->surname }}
            </div>
            <div class="collector-firm">
               <span style="width:50%;"></span> 
            </div>
            <br>
            <div class="observations">
                OBSERVACIONES: {{ $payment->observations }}    
            </div>
        </div>
    </body>
</html>
