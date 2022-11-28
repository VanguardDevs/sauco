<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            @page {
                margin-top: 0.5cm;
            }
            body {
                font-family: 'Helvetica';
                font-size: 15px;
            }
            .header {
                width: 100%;
                font-size: 9px;
                position: relative;
                display: block;
                /*background-color: #20B027;*/
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
            .description {
                margin-top: 2px;

            }

             #degrade {
                position: absolute;
                margin-top: 2px;
                z-index: -1;
            }


            #sello {
                float: right;
                margin-top: 0px;
                margin-bottom: -35px;
                margin-left: 5px;
                margin-right: 5px;
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
                margin-top: -10px;
                width: 95%;
                align: center;
                text-align: center;
            }
            .details td, h4 {
                text-align: center;
            }
            .details .object-payment {
                text-align: left;
                padding-left: 3px;
            }
            .tables {
                display:block;
                border-width: 1.5px;
                border-style: solid;
                margin-top: -4px;
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
                width: 100%;
                height: 80px;
                text-transform: uppercase;
                font-weight: 700;
                font-size: 11px;
                margin: auto;
                margin-top: 14%;
                margin-bottom: -1%;
            }
            .center {
                margin-left: auto;
                margin-right: auto;
            }
            .small {
                font-size: 8.5px;
            }
            #watermark {
                position: absolute;
                top: 175px;
                right: 250px;
                width: 200px;
                height: 200px;
                opacity: .3;
                z-index: -1;
            }
            #stamp {
                font-size: 9px;
                border-style: dotted;
                position: absolute;
                margin-top: 0%;
                left: 20px;
                width: 170px;
                margin-left: -2px;
                text-align: left;
            }

            #stamp-info{
               margin-left: -5%; 
            }
        </style>
        <title>{{ $license->num }}</title>
    </head>
    <body>
        <div id="watermark">
            <img src="{{ asset('/assets/images/escudo.jpg') }}" height="100%" width="100%" alt="sumatlogo"/>
        </div>
        <div class="container">
            <div id="degrade">
                @if($license->correlative->correlative_type_id == 1)
                <img src="{{ asset('/assets/images/degrade-1.jpeg') }}" height="85px" width="100%" alt="sumatlogo"/>
                @else
                <img src="{{ asset('/assets/images/degrade-2.png') }}" height="85px" width="100%" alt="sumatlogo"/>
                @endif
            </div>
            <div class="header">
                <div class="sumatLOGO">
                    <img src="{{ asset('/assets/images/logo_sumat.png') }}" height="90px" width="230px" alt="sumatlogo"/>
                </div>
                <div class="description text-center">
                <p>
                    REPÚBLICA BOLIVARIANA DE VENEZUELA<br>
                    ESTADO SUCRE<br>
                    ALCALDÍA DEL MUNICIPIO BERMÚDEZ<br>
                    SUPERINTENDENCIA MUNICIPAL DE ADMINISTRACIÓN TRIBUTARIA<br>
                    RIF: G-20000292-1<br>
                    DIRECCIÓN: AV. CARABOBO, EDIFICIO MUNICIPAL
                    </p>
                </div>
                <div id="mayorLOGO">
                    <img src="{{ asset('/assets/images/logo_alcaldia.png') }}" height="80px" width="130px" alt="logo" />
                </div>
            </div>

            @if($license->correlative->correlative_type_id == 1)
            <div class="tables" style="border-color: maroon;">
            @else
             <div class="tables" style="border-color: green;">
            @endif
                <h4 style="margin-top: 1px;" >REGISTRO DE EXPENDIO DE BEBIDAS ALCOHÓLICAS</h4>
                <table class="center">
                    <thead>
                        <tr>
                            <th colspan="2" style="font-size: 12px; padding: 2px 1px;"><strong>Nº DE REGISTRO</strong> {{ $liqueur->num }} DE FECHA {{ $registeredAt }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @if($license->correlative->correlative_type_id == 1)
                            <td><strong>PERIODO DE INSTALACIÓN:</strong> {{ $period }}</td>
                            @else
                            <td><strong>PERIODO DE RENOVACIÓN:</strong> {{ $period }}</td>
                            @endif
                            <td><strong>FECHA DE VENCIMIENTO:</strong> {{ $license->expiration_date }}</td>
                        </tr>
                        <tr>
                            <td width="65%"><strong>NOMBRE O RAZÓN SOCIAL:</strong> {{ $license->taxpayer->name }}</td>
                            <td width="35%"><strong>RIF: </strong>{{ $license->taxpayer->rif }}</td>
                        </tr>
                    <tr>
                        <td><strong>DIRECCIÓN:</strong> {{ $license->liqueur->address }}</td>
                        <td><strong>DENOMINACIÓN:</strong> {{ $license->taxpayer->commercialDenomination->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>REPRESENTANTE LEGAL:</strong> {{ $representation->name }}</td>
                        <td><strong>C.I:</strong> {{ $representation->document }}</td>
                    </tr>
                    <tr>
                        <td><strong>CLASIFICACIÓN DEL EXPENDIO:</strong> {{ $liqueur->liqueurClassification->name }}</td>
                        <td>
                            <strong>ANEXO(S):</strong>
                            <br />
                            @foreach($liqueur->annexes as $annex)
                                <span>{{ $annex->name.', ' }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-size: 12px;"><strong>HORARIO DE TRABAJO:</strong> {{ $liqueur->work_hours }}</td>
                    </tr>
                    </tbody>
                </table>
                <div>
                    @if($revenueStamp)
                        <div id="stamp" style=" z-index: 2;">
                            <span class="row" id="stamp-info">Comprobante de Pago de Timbre Fiscal </span>
                            <span class="row" id="stamp-info">SABATES</span>
                            <span class="row" id="stamp-info">Fecha: {{$revenueStamp->date}}</span>  
                            <span class="row" id="stamp-info">Recibo Nº: {{$revenueStamp->payment_num}}</span>
                            <span class="row" id="stamp-info">Monto Bs: {{$revenueStamp->amount}}</span>
                            <span class="row" id="stamp-info">Concepto: {{$revenueStamp->observations}}</span>
                        </div>
                        
                    @endif

                    <div id="sello" style=" z-index: 2;">
                        <img src="{{ asset('/assets/images/sello.png') }}" height="70px" width="170px"/>
                    </div>

                    <div class="bottom text-center" style="z-index: -1;">
                        <span class="row">{{ $signature->title }}</span>
                        <span class="row">superintendente de administración tributaria</span>
                        <span class="row">RESOLUCIÓN Nº 357 DE FECHA 30-11-2021</span>
                        <span class="row small">GACETA MUNICIPAL EXTRAORDINARIA Nº 378 DE FECHA 30-11-2021</span>
                        <span class="row small">FIRMA AUTORIZADA DE ACUERDO CON EL ARTÍCULO 7 DE LA ORDENANZA QUE REGULA EL FUNCIONAMIENTO DEL EXPENDIO DE BEBIDAS ALCOHÓLICAS</span>
                        <span class="row small">Correspondiente al Registro {{ $license->num }} de Fecha {{$license->emission_date }} Tasa Administrativa pagada en fecha {{ $processedAt }} con Factura Nº {{ $payment ? $payment->num : null }}</span>
                    </div>
                </div>
                <div class="bandera">
                    <img src="{{ asset('/assets/images/bandera.png') }}" height="35px" width="99.9%" alt="sumatlogo"/>
                </div>
            </div>
        </div>
    </body>
</html>
