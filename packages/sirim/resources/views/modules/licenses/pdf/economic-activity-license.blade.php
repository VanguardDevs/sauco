<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            /* @font-face {
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 300;
                src: url(https://fonts.gstatic.com/s/roboto/v29/KFOlCnqEu92Fr1MmSU5vAw.ttf) format('truetype');
            }
            @font-face {
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                src: url(https://fonts.gstatic.com/s/roboto/v29/KFOmCnqEu92Fr1Me5Q.ttf) format('truetype');
            }
            @font-face {
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 700;
                src: url(https://fonts.gstatic.com/s/roboto/v29/KFOlCnqEu92Fr1MmWUlvAw.ttf) format('truetype');
            }
            body {
                height: 100%;
                width: 100%;
                position: relative;
                font-family: 'Roboto', 'sans-serif';
            }
            #watermark {
                position: absolute;
                bottom: 0px;
                right: 0px;
                width: 710px;
                height: 1050px;
                opacity: 1;
                z-index: 1;
            }
            .container {
                position: relative;
                display: block;
                top: 150px;
                left: 14px;
                overflow: hidden;
                width: 670px;
                height: 835px;
                z-index: 9;
            }
            .c-text-right {
                width: 40%;
                text-align: right;
                font-size: 15px;
                font-weight: 700;
                float: left;
            }
            .c-text-left {
                width: 60%;
                text-align: left;
                font-size: 15px;
                font-weight: 400;
                float: right;
            }
            .header {
                display: block;
                width: 100%;
                height: 200px;
            }
                .qr-code-container {
                    width: 100%;
                    height: 150px;
                    float: left;
                    padding-left: 21%;
                    padding-top: 40px;
                }
                    .qr-code {
                        width: 122px;
                        height: 122px;
                    }
                .header-title {
                    margin-top: 34px;
                    height: 130px;
                    width: 40%;
                    float: right;
                    font-size: 28px;
                    font-weight: 700;
                    color: red;
                    line-height: 26px;
                    margin-right: 120px;
                }
                .license-num {
                    color: black
                }
            .dates {
                width: 100%;
                height: 50px;
            }
            .text-center {
                text-align: center;
            }
            .caption {
                height: 40px;
                padding-top: 10px;
                padding-bottom: 10px;
                text-decoration: underline;
                font-size: 24px;
                font-weight: 700;
            }
            .row {
                display: block;
                padding-left: 10px;
            }
            .information {
                width: 100%;
                height: 350px;
            }
            .bottom {
                width: 80%;
                height: 170px;
                z-index: 1000;
                text-transform: uppercase;
                font-weight: 700;
                font-size: 12px;
                margin: auto;
                bottom: 25px;
                position: absolute;
                left: 10%;
            }
            hr {
                display: block;
                height: 1px;
                border: 0;
                border-top: 2px solid black;
                margin: 1em 0;
                padding: 0;
                width: 50%;
                margin-left: 170px;
            }
            .spacing {
                margin-top: 45px;
            } */



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



        </style>
    </head>
    <body>
        <!-- <div id="watermark">
            <img src="{{ asset('/assets/images/licenses/fondo.jpeg') }}" height="100%" width="100%"/>
        </div>
        <div class="container">
            <div class="header">
                <div class="qr-code-container">
                    <div class="qr-code">
                        <img
                            src="data:image/png;base64, {{ base64_encode(QrCode::size(150)->generate($qrLicenseString)) }}"
                            width="100%"
                            height="100%"
                        />
                    </div>
                </div>
                <div class="header-title">
                    LICENCIA DE ACTIVIDADES ECONÓMICAS <br/>Nº
                    <span class="license-num">{{ $licenseCorrelative }}</span>
                </div>
            </div>
            <div class="dates">
                <div class="c-text-right">
                    <div class="row">
                        FECHA DE EMISIÓN:
                    </div>
                    <div class="row">
                        FECHA DE VENCIMIENTO:
                    </div>
                </div>
                <div class="c-text-left">
                    <div class="row">
                        {{ $license->emission_date }}
                    </div>
                    <div class="row">
                        {{ $license->expiration_date }}
                    </div>
                </div>
            </div>
            <div class="information">
                <div class="text-center caption">
                    <span>DATOS DEL CONTRIBUYENTE</span>
                </div>
                <div class="c-text-right">
                    <div class="row">
                        REGISTRO Nº:
                    </div>
                    <div class="row">
                        NOMBRE O RAZÓN SOCIAL:
                    </div>
                    <div class="row">
                        RIF:
                    </div>
                    <div class="row">
                        REPRESENTANTE LEGAL:
                    </div>
                    <div class="row">
                        DIRECCIÓN FISCAL:
                    </div>
                    <div class="row spacing">
                        ACTIVIDADES ECONÓMICAS:
                    </div>
                </div>
                <div class="c-text-left">
                    <div class="row">
                        {{ $num }}
                    </div>
                    <div class="row">
                        {{ $license->taxpayer->name }}
                    </div>
                    <div class="row">
                        {{ $license->taxpayer->rif }}
                    </div>
                    <div class="row">
                        {{ $representation }}
                    </div>
                    <div class="row">
                        {{ $license->taxpayer->fiscal_address }}
                    </div>
                    @foreach($license->economicActivities->take(5) as $activity)
                    <span class="row">
                        {{ $activity->code.' - '.substr($activity->name, 0, 29) }}
                    </span>
                    @endforeach
                </div>
            </div>
            <div class="bottom text-center">
                <span class="row">{{ $signature->title }}</span>
                <span class="row">superintendente de administración tributaria</span>
                <span class="row">{{ $signature->decree }}</span>
                <span class="row">GACETA MUNICIPAL EXTRAORDINARIA Nº 378 DE FECHA 30-11-2021</span>
                <span class="row">Este documento debe permanecer en un sitio visible dentro del establecimiento a los fines de su fiscalización</span>
            </div>
        </div> -->


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





    </body>
</html>
