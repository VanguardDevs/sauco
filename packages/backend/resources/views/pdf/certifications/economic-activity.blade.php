<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            @font-face {
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
                top: 130px;
                left: 14px;
                overflow: hidden;
                width: 670px;
                height: 785px;
                z-index: 9;
            }
            .c-text-right {
                width: 40%;
                text-align: right;
                font-size: 16px;
                font-weight: 700;
                float: left;
            }
            .c-text-left {
                width: 60%;
                text-align: left;
                font-size: 16px;
                font-weight: 400;
                float: right;
            }
            .header {
                display: block;
                width: 100%;
                height: 200px;
            }
                .qr-code {
                    width: 50%;
                    height: 150px;
                    float: left;
                    text-align: center;
                    padding-top: 30px;
                }
                .header-title {
                    margin-top: 10px;
                    height: 180px;
                    width: 50%;
                    float: right;
                    font-size: 35px;
                    font-weight: 700;
                    color: red;
                    line-height: 35px;
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
                height: 400px;
            }
            .bottom {
                width: 100%;
                height: 150px;
                z-index: 1000;
                text-transform: uppercase;
                font-weight: 700;
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
        </style>
    </head>
    <body>
        <div id="watermark">
            <img src="{{ asset('images/licenses/actividad-economica.jpg') }}" height="100%" width="100%"/>
        </div>
        <div class="container">
            <div class="header">
                <div class="qr-code">
                    <img
                        src="{{ asset('images/escudo.jpg') }}"
                        height="120px"
                        width="150px"
                    />
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
                        DIRECCIÓN:
                    </div>
                    <div class="row">
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
                        {{ substr($license->taxpayer->fiscal_address, 0, 39) }}
                    </div>
                    @foreach($license->economicActivities->take(5) as $activity)
                    <span class="row">
                        {{ $activity->code.' - '.substr($activity->name, 0, 29) }}
                    </span>
                    @endforeach
                </div>
            </div>
            <div class="bottom text-center">
                <span class="row"><hr/></span>
                <span class="row">{{ $signature->title }}</span>
                <span class="row">superintendente de administración tributaria</span>
                <span class="row">{{ $signature->title }}</span>
            </div>
        </div>
    </body>
</html>
