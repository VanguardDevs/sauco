<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>LICENCIA {{ $license->num }}</title>
        <style>
            body {
                font-family: 'Helvetica';
                font-size: 15px;
            }
            .header {
                width: 100%;
                font-size: 8.2px;
                position: relative;
                display: block;
            }
            .header div {
                display: inline-block;
            }
            

            #mayorLOGO {
                float: right;
                margin-top: 2px;
            }
            .sumatLOGO {
                margin-top: 3px;
            }
            table, td, th {
                border: 1px #000 solid;
            }
            td {
                font-size: 10px;
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
                border-color: blue;
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
            /*.bottom {
                width: 100%;
                height: 150px;
                text-transform: uppercase;
                font-weight: 700;
                font-size: 12px;
                margin-top: 5%;
                position: absolute;
                left: 0%;
            }*/

            .bottom {
                width: 95%;
                height: 110px;
                text-transform: uppercase;
                font-weight: 700;
                font-size: 9px;
                margin: auto;
                margin-top: 2.5%;
                margin-bottom: -8%;
            }
            .description {
                text-align: center;
                padding-left: 5px;
                margin-top: 2px;
            }
            input{
               margin-top: 3.5%;
               margin-bottom: -9%;
            }
            .tables--container {
                width: 95%;
                margin: auto;

            }
            #watermark {
                position: absolute;
                top: 165px;
                right: 250px;
                width: 200px;
                height: 200px;
                opacity: .3;
                z-index: -1;
            }

              #degrade {
                position: absolute;
                margin-top: 2px;
                z-index: -1;
            }

            #sello {
                float: right;
                margin-top: -1px;
                margin-bottom: -35px;
                margin-right: 5px;
            }

        </style>
    </head>
    <body>
        <div id="watermark">
            <img src="{{ asset('/assets/images/escudo.jpg') }}" height="100%" width="100%" alt="sumatlogo"/>
        </div>
        <div class="container">
            <div id="degrade">
                @if($license->correlative->correlative_type_id == 1)
                <img src="{{ asset('/assets/images/degrade-4.jpeg') }}" height="85px" width="100%" alt="sumatlogo"/>
                @else
                <img src="{{ asset('/assets/images/degrade-3.jpeg') }}" height="85px" width="100%" alt="sumatlogo"/>
                @endif
            </div>
            <div class="header">
                <div class="sumatLOGO">
                    <img src="{{ asset('/assets/images/logo_sumat.png') }}" height="89px" width="210px" alt="sumatlogo"/>
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
                    <img src="{{ asset('/assets/images/logo_alcaldia.png') }}" height="80px" width="130px" alt="logo" />
                </div>
            </div>

            <div class="tables">
                <h4 style="margin-top: 1px; margin-bottom: 9px; text-align: center;" >LICENCIA DE ACTIVIDADES ECONÓMICAS</h4>

                <div class="tables--container">
                    <table class="table" style="margin-bottom:0;">
                        <tbody>

                            <tr>
                            <td width="80%">
                                    <dt style="text-align: center;"><strong>NÚMERO:</strong> {{ $license->num }}</dt>
                                </td>
                                <td width="20%">
                                    <dt><strong>INMUEBLE PROPIO:  </strong> SI <input type="checkbox" /> NO <input type="checkbox" />

                                    </dt>
                                </td>

                            </tr>

                            <tr>
                            <td width="65%">
                                    <dt><strong>CONTRIBUYENTE:</strong> {{ $license->taxpayer->name }}</dt>
                                </td>
                                <td width="35%">
                                    <dt><strong>RIF:</strong> {{ $license->taxpayer->rif }}</dt>
                                </td>
                            </tr>

                            <tr>
                            <td>
                                    <dt><strong>DIRECCIÓN:</strong> {{ $license->taxpayer->fiscal_address }}</dt>

                                </td>
                                <td>
                                    <dt><strong>REGISTRO:</strong> {{ $num }}</dt>
                                </td>
                            </tr>

                            <tr>
                            <td>
                                    <!-- @if($license->correlative->correlative_type_id == 1)
                                        <dt><strong>FECHA DE INSCRIPCIÓN</strong> {{ $license->emission_date }}</dt>
                                        @endif
                                    -->
                                    <dt><strong>FECHA DE EMISIÓN: </strong> {{ $license->emission_date }}</dt>

                                </td>
                                <td>
                                    <dt><strong>FECHA DE VENCIMIENTO:</strong> {{ $license->expiration_date }}</dt>
                                </td>
                            </tr>

                            <tr>
                            <td>
                                    <dt><strong>REPRESENTANTE LEGAL:</strong> {{ $representation->name }}</dt>

                                </td>
                                <td>
                                    <dt><strong>C.I:</strong> {{ $representation->document }}</dt>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <table class="table" style="text-align: center;">
                        <tr>
                            <th colspan = "4">ACTIVIDADES ECONÓMICAS
                            </th>
                        </tr>
                        <thead>
                            <tr>
                                <th width="10%">CÓDIGO</th>
                                <th width="60%">NOMBRE</th>
                                <th width="13%">ALICUOTA (%)</th>
                                <th width="17%">MÍNIMO TRIBUTABLE (PETRO)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($license->economicActivities as $activity)
                            <tr>
                                <td>{{ $activity->code }}</td>
                                <td>{{ substr($activity->name, 0, 80)}}</td>
                                <td>{{ $activity->aliquote }}</td>
                                <td>{{ $activity->min_tax }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div id="sello" style=" z-index: 2;">
                        <img src="{{ asset('/assets/images/selloAE.png') }}" height="65px" width="163px"/>
                    </div>
                <br>
                <br>
                <div class="bottom text-center" style="z-index: -1;">
                    <span class="row">{{ $signature->title }}</span>
                    <span class="row">superintendente de administración tributaria.</span>
                    <span class="row">RESOLUCIÓN Nº 357 DE FECHA 30-11-2021. GACETA MUNICIPAL EXTRAORDINARIA Nº 378 DE FECHA 30-11-2021</span>
                    <span class="row">La retención de este documento solo es competencia de la superintendencia municipal de administración tributaria (SUMAT)</span>
                </div>
                <div class="bandera">
                    <img src="{{ asset('/assets/images/bandera.png') }}" height="35px" width="99.9%" alt="sumatlogo"/>
                </div>
            </div>
        </div>
    </body>
</html>
