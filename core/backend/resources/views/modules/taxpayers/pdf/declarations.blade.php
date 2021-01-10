<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!-- CSRF Token -->
        <title> Contribuyente  </title>
        <style>
           body {
                font-family: sans-serif, serif;
                font-size: 14px;
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
                border: 1px #000 solid;
            }
            td {
                font-size: 11px;
                padding: 4px;
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
            }
            .total-amount {
                text-align: right;
            }
            .miscellaneus {
                font-size: 10px;
            }
            caption {
                font-weight: bold;
            }
        </style>
    </head>

    <body>
        <div class="header">
            <div class="sumatLOGO">
                <img src="{{ asset('assets/images/sumat.png') }}" height="90px" width="230px" alt="sumatlogo"/>
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
                <img src="{{ asset('assets/images/logo.png') }}" height="70px" width="130px" alt="logo" />
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
                        <td>{{ $taxpayer->rif }}</td>
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
                        <td>{{ $taxpayer->fiscal_address.', '.$taxpayer->community->name }}</td>
                    </tr>
                </tbody>
            </table>
            @foreach ($settlements as $settlement)
            <table class="" style="text-align: center">
                <caption>DECLARACIÓN: MES DE {{ $settlement->month->name }} {{ $settlement->month->year->year }}</caption>
                <thead>
                  <tr>
                    <th width="10%">CÓDIGO</th>
                    <th width="50%">ACTIVIDAD</th>
                    <th width="20%">DECLARADO</th>
                    <th width="20%">CALCULADO</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($settlement->economicActivitySettlements as $declaration)
                    <tr>
                        <td>{{ $declaration->economicActivity->code }}</td>
                        <td>{{ $declaration->economicActivity->name  }}</td>
                        <td>{{ $declaration->bruteAmountFormat }}</td>
                        <td>{{ $declaration->amountFormat }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td>{{ $settlement->economicActivitySettlements->sum('brute_amount') }}</td>
                        <td>{{ $settlement->amountFormat }}</td>
                    </tr>
                </tbody>
            </table>
            @endforeach

        </div>
    </body>
</html>
