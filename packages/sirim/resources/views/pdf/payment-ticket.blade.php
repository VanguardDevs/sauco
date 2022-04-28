<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!-- CSRF Token -->
        <title> Factura </title>
        <style>
            @page {
                margin-left: 12px;
                margin-right: 12px;
                margin-top: 12px;
                margin-bottom: 12px;
            }
           body {
                font-family: 'Helvetica';
                font-size: 10px;
            }
            .header {
                width: 100%;
                position: relative;
                display: block;
            }
            .header div {
                display: inline-block;
                text-align:center;
            }
            caption {
                font-weight: bold;
            }
            .sections {
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
            <p style="text-align: center; font-weight: bold;">DATOS GENERALES DEL CONTRIBUYENTE</p>
            <p>
            <span>RIF:</span> {{ $payment->taxpayer->rif }}<br>
            <span>NOMBRE: </span>{{ $payment->taxpayer->name }}<br>
            <span>DIRECCIÓN: </span>{{ $payment->taxpayer->fiscal_address }}<br>
            </p>
        </div>
        <div class="sections">
        <p style="text-align: center; font-weight: bold;">DETALLES DEL COBRO</p>
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
