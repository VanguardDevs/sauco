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
            .titulo{
                display: block;
                align: center;
                text-align: center;
            }

            #fecha-pdf{
                display: block;
                align: right;
                text-align: right;

            }
            .description {
                text-align: center;
                padding-left: 5px;
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
                /* height: 170px; */
                /* z-index: 1000; */
                text-transform: uppercase;
                font-weight: 700;
                font-size: 12px;
                margin: auto;
                margin-top: 10%;
                /* position: absolute; */
                left: 10%;
            }
            #watermark {
                position: absolute;
                top: 175px;
                right: 150px;
                width: 400px;
                height: 400px;
                opacity: 0.3;
                z-index: -1;
            }
        </style>
    </head>
    <body>
        <div id="watermark">
            <img src="{{ asset('/assets/images/escudo.jpg') }}" height="100%" width="100%" alt="sumatlogo"/>
        </div>
        <div class="container">
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
                    <img src="{{ asset('/assets/images/logo_alcaldia.jpg') }}" height="79px" width="130px" alt="logo" />
                </div>
            </div>
            <br>
            <div class="row">
                <p class="titulo">RESOLUCIÓN DE CESE DE ACTIVIDADES</p>
            </div>
            <br>

            <div class="row" style="text-align: justify;">
            El suscrito, VENANCIO MEZA DÍAZ, actuando en este Acto en su carácter de Superintendente Municipal Tributario  ------ a la función ejecutiva de la municipalidad de Bermúdez del estado Sucre, visto la solicitud presentada por el ciudadano(a) {{ $license->representation->person->name }}, titular de la cédula de identidad {{ $license->representation->person->document }}, en su carácter de Presidente de la Sociedad Mercantil {{ $license->taxpayer->commercialDenomination->name }}, identificada con el RIF {{ $license->taxpayer->rif }}, Poseedor de la Licencia de Ejercicio de Actividades Económicas, Registro N.º {{ $license->num }}, y cumplido los requisitos establecidos
            </div>
            <br><br>
            <p style="text-align:center;"><u>RESUELVE</u></p>
            <div class="row" style="text-align: justify;">
                <u>Primero:</u> Se otorga  Cese de Ejercicio de Actividades Económicas,  al contribuyente {{ $license->taxpayer->commercialDenomination->name }}, RIF {{ $license->taxpayer->rif }}, Registro Municipal N.º {{ $license->num }}, por tanto, desde la presente fecha se desincorpora la misma de los registros que al efecto mantiene esta dependencia de Administración Tributaria - -- - -
            </div>
            <br>
            <div class="row" style="text-align: justify;">
                <u>Segundo:</u> Notifiquese del presente acto al ciudadano(a) {{ $license->representation->person->name }}, C.I {{ $license->representation->person->document }} en su carácter de representante legal de la Sociedad Mercantil {{ $license->taxpayer->commercialDenomination->name }}.
            </div>
            <br>
            <div class="row">
                <strong>Carúpano</strong>, {{ date('d-m-Y') }}
            </div>


            <div class="bottom text-center">
                <span class="row">{{ $signature->title }}</span>
                <span class="row">superintendente de administración tributaria</span>
                <span class="row">{{ $signature->decree }}</span>
                <span class="row">GACETA MUNICIPAL EXTRAORDINARIA Nº 378 DE FECHA 30-11-2021</span>
            </div>
        </div>
    </body>
</html>
