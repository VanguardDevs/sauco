<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!-- CSRF Token -->
        <title> Factura {{ $payment->num }} </title>
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
            .miscellaneus {
                font-size: 12px;
                background: black;
            }
            caption {
                font-weight: bold;
            }
            th {
                font-size: 10px;
                padding: 3px 1px;
            }
            .column {
                text-align: left !important;
                border: none;
            }
            .column--left {
                width: 60% !important;
            }
            .column--right {
                text-align: right !important;
            }
            .strong {
                font-weight: bold !important;
                text-transform: uppercase !important;
            }
            .larger {
                font-size: 15px !important;
            }
            hr {
                margin-top: 50px;
                width: 40%;
                background: black;
            }
        </style>
    </head>

    <body>
        <div class="header">
            <div class="sumatLOGO">
                <img src="{{ asset('/assets/images/logo_sumat.png') }}" height="90px" width="230px" alt="sumatlogo"/>
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
                <img src="{{ asset('/assets/images/logo_alcaldia.jpg') }}" height="80px" width="130px" alt="logo" />
            </div>
        </div>
        <div class="tables">
            <table class="table" style="text-align: center;margin-bottom:0;">
                <thead>
                  <tr>
                    <th width="85%">RAZÓN SOCIAL</th>
                    <th width="15%">RIF</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td >{{ $denomination }}</td>
                        <td>{{ $payment->taxpayer->rif }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: left; padding-left: 3px;">
                            <strong>DIRECCIÓN:</strong> {{ $payment->taxpayer->fiscal_address }}
                        </td>
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
                        <td>{{ $payment->references->first()->reference ?? 'S/N' }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="details">
                <caption>DETALLES DEL PAGO</caption>
                <thead>
                  <tr>
                    <th width="12%">Nº LIQUIDACIÓN</th>
                    <th width="68%">DETALLES</th>
                    <th width="20%">MONTO TOTAL</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($payment->liquidations as $liquidation)
                 <tr>
                    <td>{{ $liquidation->num }}</td>
                    <td class="object-payment">{{ $liquidation->object_payment  }}</td>
                    <td style="word-spacing:1px;font-size:16px;">{{ $liquidation->pretty_amount }}</td>
                </tr>
                @endforeach
             </table>
        </div>
        <br>
        <div class="tables">
            <table class="details" style="border: none;">
                <tbody class="larger">
                    <tr>
                        <td class="column column--left strong">Nº DE FACTURA: {{ $payment->num }}</td>
                        <td class="column column--right">
                            <span class="strong">
                                TOTAL:
                            </span>
                            <span class="strong">
                                {{ $payment->pretty_amount }}
                            </span> Bs
                        </td>
                    </tr>
                    <tr>
                        <td class="column column--left">
                            <span class="strong">
                                Recaudador:
                            </span>
                            {{ $payment->user->full_name }}
                        </td>
                        @if($payment->credits()->exists())
                            <td class="column column--right">
                                <span class="strong">
                                    CRÉDITO:
                                </span>
                                <span class="strong">
                                    {{ number_format($payment->credits()->sum('amount'), 2, ',', '.') }}
                                </span> Bs
                            </td>
                        @elseif ($payment->deductions()->exists() && !$payment->credits()->exists())
                            <td class="column column--right">
                                <span class="strong">
                                    RETENCIONES:
                                </span>
                                <span class="strong">
                                    {{ number_format($payment->deductions()->sum('amount'), 2, ',', '.') }}
                                </span> Bs
                            </td>
                        @endif
                    </tr>
                    @if($payment->deductions()->exists() && $payment->credits()->exists())
                    <tr>
                        <td colspan="2" class="column column--right">
                            <span class="strong">
                                RETENCIONES:
                            </span>
                            <span class="strong">
                                {{ number_format($payment->deductions()->sum('amount'), 2, ',', '.') }}
                            </span> Bs
                        </td>
                    </tr>
                    @endif
                    @if($payment->observations)
                        <tr>
                            <td colspan="2" class="column">
                                <span class="strong">OBSERVACIONES:</span> {{ $payment->observations }}
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div style="width: 100%; text-align: center;">
                <hr>
                <span class="strong">FIRMA</span>
            </div>
        </div>
    </body>
</html>
