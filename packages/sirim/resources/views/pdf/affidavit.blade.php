<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!-- CSRF Token -->
        <title> Comprobante de actividad económica </title>
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
                margin-top: 10px;
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
                font-size: 14px;
                margin-top: 15px;
            }
            caption {
                font-weight: bold;
                margin-bottom: 5px;
            }
            th {
                font-size: 10px;
                padding: 3px 1px;
            }
            #user{
                font-weight: bold;
                font-size: 15px;
            }
            #date-info {
                font-size: 15px;
                font-weight: bold;
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

        <p>
            Declaración{{ ' Nº ' .$affidavit->num }} para el período {{ $affidavit->month->name }} -  {{ $affidavit->month->year->year }}</h3>

        </p>
        <div class="tables">
            <table class="table" style="text-align: center">
                <caption>Datos generales del contribuyente</caption>
                <thead>
                  <tr>
                    <th width="85%">Nombre</th>
                    <th width="15%">RIF</th>
                  </tr>
                </thead>
                <tbody>
                     <tr>
                        <td>{{ $affidavit->taxpayer->name }}</td>
                        <td>{{ $affidavit->taxpayer->rif }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: left; padding-left: 3px;">
                            <strong>DIRECCIÓN:</strong> {{ $affidavit->taxpayer->fiscal_address }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <br>
            <table class="table" style="text-align: center">
                <caption>Declaraciones por actividad económica</caption>
                <thead>
                  <tr>
                    <th width="10%">Código</th>
                    <th width="65%">Nombre de la actividad</th>
                    <th width="15%">Declarado</th>
                    <th width="15%">Calculado</th>

                  </tr>
                </thead>
                <tbody>
                    @foreach($affidavit->economicActivityAffidavits as $EconomicActivity)
                     <tr>
                        <td>{{ $EconomicActivity->economicActivity->code }}</td>
                        <td>{{ $EconomicActivity->economicActivity->name }}</td>
                        <td>{{ $EconomicActivity->affidavit_amount }}</td>
                        <td>{{ $EconomicActivity->calc }}</td>

                    </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
        <br>

        <div id="bill-info">
            <div class="col-bill-info">
                Monto total declarado: {{ $affidavit->prettyTotalBruteAmount }} Bs
            </div>
            <div class="col-bill-info">
                <div class="total-amount">
                    Monto total calculado: {{ $affidavit->prettyTotalCalcAmount }} Bs
                </div>
            </div>
        </div>
        <br><br>
        <div class="miscellaneus">
            <div class="observations">
                <span id="date-info">Fecha de ingreso:</span> {{ $affidavit->processed_at }}
            </div>
            <br>
            <div class="observations">
                <span id="user">Usuario:</span> {{ $affidavit->user->full_name }}
            </div>
        </div>
    </body>
</html>
