<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!-- CSRF Token -->
        <title> Comprobante Liquidación</title>
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
                text-align: center;
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
            .tables {
                display:block;
                margin-top: 25px;
            }
            #user {
                font-weight: bold;
            }
            .user-info {
                float: left;
                width: 50%;
                font-size: 16px;
            }
            caption {
                font-weight: bold;
                margin-bottom: 20px;
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

           <table class="details">
                <caption>COMPROBANTE DE LIQUIDACIÓN</caption>

                <thead>
                    <tr>
                        <td colspan="3" style="text-align: left; padding-left: 3px;">
                            <strong>CONCEPTO:</strong> {{ $liquidation->object_payment }}
                        </td>
                    </tr>
                    <tr>
                        <th width="15%">Nº LIQUIDACIÓN</th>
                        <th width="60%">MONTO</th>
                        <th width="25%">FECHA</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $liquidation->num }}</td>
                        <td style="word-spacing:1px;font-size:16px;">{{ $liquidation->pretty_amount }}</td>
                        <td >{{ $liquidation->created_at }}</td>
                    </tr>
             </table>
        </div>
        <br>
        <div class="tables">
            <table class="details" style="border: none;">
                <tbody class="larger">
                    <tr>
                        <td class="column column--left">
                            <span class="strong">
                                Recaudador:
                            </span>
                            {{ $liquidation->liquidable->user->full_name }}
                        </td>
                    </tr>
                    @if($liquidation->deduction()->exists())
                        <tr>
                            <td class="column column--left">
                                <span class="strong">
                                    Retención:
                                </span>
                                <span class="strong">
                                    {{ $liquidation->deduction->pretty_amount }}
                                </span> Bs
                            </td>
                        </tr>
                    @endif

                    @if($liquidation->credit()->exists())
                        <tr>
                            <td class="column column--left">
                                <span class="strong">
                                    CRÉDITO:
                                </span>
                                <span class="strong">
                                    {{ $liquidation->credit->pretty_amount }}
                                </span> Bs
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
