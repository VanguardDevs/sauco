<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!-- CSRF Token -->
        <title> Factura </title>
        <style>
           body {
                font-family: 'Helvetica';
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
                text-align:center;
            }
            #mayorLOGO {
                float: right;
                margin-top: -10px;
            }
            table, td, th {
                border: 1px #000 solid;
            }
            td {
                font-size: 12px;
                padding: 2px 1px;
            }
            table {
                border-collapse: collapse;
                width: 100%;
                margin-top: 5px;
            }
            .details td {
                text-align: center;
            }
            .details .object-payment {
                text-align: left;
                padding-left: 3px;
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
            .sections {
                font-size: 9px;
            }
            span{
                font-weight: bold;
            }
        </style>
    </head>

    <body>
        <div class="header">
            <div class="description">
               <p>
                ALCALDÍA DEL MUNICIPIO BERMÚDEZ<br>
                SUPERINTENDENCIA MUNICIPAL DE ADMINISTRACIÓN TRIBUTARIA<br>
                RIF: G-20000222-1<br>
                DIRECCIÓN: AV. CARABOBO, EDIFICIO MUNICIPAL
                </p>
            </div>
        </div>

        <div class="sections">
            <p>
            <span>DATOS GENERALES DEL CONTRIBUYENTE</span><br>
            <span>RIF:</span> {{ $payment->taxpayer->rif }}<br>
            <span>NOMBRE: </span>{{ $payment->taxpayer->name }}<br>
            <span>DIRECCIÓN: </span>{{ $payment->taxpayer->fiscal_address }}<br>
            </p>
        </div>
        <div class="sections">
            <p><span>DETALLES DEL COBRO</span><br>
            <span>Nº LIQUIDACIÓN: </span>{{ $liquidation->num }}<br>
            <span>CONCEPTO: </span>{{ $liquidation->object_payment }}<br>
            <span>MONTO: </span>{{ $liquidation->pretty_amount }}<br>
            </p>
        </div>
        <div class="sections">
            <span>PAGO TOTAL: </span>{{ $payment->pretty_amount }} Bs<br><br>
            <span>N° DE FACTURA: </span>{{ $payment->num }}<br>
            <span>RECAUDADOR: </span>{{ $payment->user->full_name }}<br>
            <span>MÉTODO DE PAGO: </span>{{ $payment->paymentMethod->name }}<br>
            <span>FECHA: </span>{{ $payment->processed_at }}

            <br>
            <span>OBSERVACIONES: </span>{{ $payment->observations }}

        </div>
    </body>
</html>
