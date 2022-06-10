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
                width: 80%;
                height: 170px;
                z-index: 1000;
                text-transform: uppercase;
                font-weight: 700;
                font-size: 12px;
                margin: auto;
                margin-top: 10%;
                position: absolute;
                left: 10%;
            }

        </style>
    </head>
    <body>
        <div class="container">
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

                <tbody>
                    <tr>
                        <td>
                            <dl style="text-align: left; padding-left: 8px;">
                                <dt><strong>NÚMERO:</strong> {{ $license->num }}</dt>
                                <dt><strong>RAZÓN SOCIAL:</strong> {{ $license->taxpayer->name }}</dt>
                                <dt><strong>DIRECCIÓN:</strong> {{ $license->taxpayer->fiscal_address }}</dt>
                                <dt><strong>REGISTRO:</strong> {{ $num }}</dt>
                                @if($license->correlative->correlative_type_id == 1)
                                <dt><strong>FECHA DE INSCRIPCIÓN</strong> {{ $license->emission_date }}</dt>
                                @endif
                                <dt><strong>FECHA DE EMISIÓN</strong> {{ $license->emission_date }}</dt>
                                <dt><strong>FECHA DE VENCIMIENTO:</strong> {{ $license->expiration_date }}</dt>
                                <dt><strong>REPRESENTANTE:</strong> {{ $representation }}</dt>
                            </dl>
                        </td>
                    </tr>
                </tbody>
            </table>
            <br>
            <table class="table" style="text-align: center;">
                <tr>

                    <th colspan = "4">ACTIVIDADES ECONÓMICAS
                    </th>
                </tr>
                <thead>
                    <tr>
                        <th width="10%">CÓDIGO</th>
                        <th width="60%">NOMBRE</th>
                        <th width="15%">ALICUOTA</th>
                        <th width="15%">MÍNIMO</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($license->economicActivities->take(3) as $activity)
                    <tr>
                        <td>{{ $activity->code }}</td>
                        <td>{{ substr($activity->name, 0, 29)}}</td>
                        <td>{{ $activity->aliquote }}</td>
                        <td>{{ $activity->min_tax }}</td>

                  </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
        <div class="bottom text-center">
            <span class="row">{{ $signature->title }}</span>
            <span class="row">superintendente de administración tributaria</span>
            <span class="row">{{ $signature->decree }}</span>
            <span class="row">GACETA MUNICIPAL EXTRAORDINARIA Nº 378 DE FECHA 30-11-2021</span>
            <span class="row">Este documento debe permanecer en un sitio visible dentro del establecimiento a los fines de su fiscalización</span>
        </div>
        </div>

        <br><br><br><br><br><br><br><br><br><br><br><br><br><br>


        <div class="container">
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

                <tbody>
                    <tr>
                        <td>
                            <dl style="text-align: left;">
                                <dt><strong>RAZÓN SOCIAL:</strong> {{ $license->taxpayer->name }}</dt>
                                <dt><strong>DIRECCIÓN:</strong> {{ $license->taxpayer->fiscal_address }}</dt>
                                <dt><strong>FECHA DE EMISIÓN</strong> {{ $license->emission_date }}</dt>
                                <dt><strong>FECHA DE VENCIMIENTO:</strong> {{ $license->expiration_date }}</dt>
                                <dt><strong>REPRESENTANTE:</strong> {{ $representation }}</dt>
                            </dl>
                        </td>
                    </tr>
                </tbody>
            </table>
            <br>
            <table class="table" style="text-align: center;">
                <tr>

                    <th colspan = "4">ACTIVIDADES ECONÓMICAS
                    </th>
                </tr>
                <thead>
                    <tr>
                        <th width="10%">CÓDIGO</th>
                        <th width="60%">NOMBRE</th>
                        <th width="15%">ALICUOTA</th>
                        <th width="15%">MÍNIMO</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($license->economicActivities->take(3) as $activity)
                    <tr>
                        <td>{{ $activity->code }}</td>
                        <td>{{ substr($activity->name, 0, 29)}}</td>
                        <td>{{ $activity->aliquote }}</td>
                        <td>{{ $activity->min_tax }}</td>

                  </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
        <div class="bottom text-center">
            <span class="row">{{ $signature->title }}</span>
            <span class="row">superintendente de administración tributaria</span>
            <span class="row">{{ $signature->decree }}</span>
            <span class="row">GACETA MUNICIPAL EXTRAORDINARIA Nº 378 DE FECHA 30-11-2021</span>
            <span class="row">Este documento debe permanecer en un sitio visible dentro del establecimiento a los fines de su fiscalización</span>
        </div>

        </div>
    </body>
</html>
