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
            DATOS GENERALES DEL CONTRIBUYENTE<br>
            RIF: {{ $payment->taxpayer->rif }}<br>
            NOMBRE: {{ $payment->taxpayer->name }}<br>
            DIRECCIÓN: {{ $payment->taxpayer->fiscal_address }}<br>
            </p>
        </div>
        <div class="sections">
        <p>DETALLES DEL COBRO<br>
            Nº LIQUIDACIÓN: {{ $liquidation->num }}<br>
            CONCEPTO: {{ $liquidation->object_payment }}<br>
            MONTO: {{ $liquidation->pretty_amount }}<br>
        </p>
        </div>
        <div class="sections">
           MONTO TOTAL: {{ $payment->pretty_amount }} Bs<br>
           RECAUDADOR: {{ $payment->user->full_name }}<br>
           MÉTODO DE PAGO: {{ $payment->paymentMethod->name }}<br>
           FECHA: {{ $payment->processed_at }}

           <br>
           N° DE FACTURA: {{ $payment->num }}
            <br>
           OBSERVACIONES: {{ $payment->observations }}

        </div>


        {{-- <br>
        <div class="bill-info">
            <div class="col-bill-info">
                N° DE FACTURA: {{ $payment->num }}
            </div>
            <div class="col-bill-info">
                <div class="total-amount">
                    PAGO TOTAL: {{ $payment->pretty_amount }} Bs
                </div>
            </div>
        </div>
        <br> --}}
        {{-- <div class="miscellaneus">
            <div class="liquidator-info">
                Recaudador: {{ $payment->user->full_name }}
            </div>
            <div class="collector-firm">
               <span style="width:50%;"></span>
            </div>
            <br>
            <div class="observations">
                OBSERVACIONES: {{ $payment->observations }}
            </div>
        </div> --}}
    </body>
</html>
