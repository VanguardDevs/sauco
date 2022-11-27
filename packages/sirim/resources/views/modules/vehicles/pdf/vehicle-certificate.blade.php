<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!-- CSRF Token -->
        <title> Certificado de Vehículo </title>
        <style>
            @page {
                margin-left: 1.5cm;
                margin-bottom: 19cm;
            }

           body {
                font-family: 'Helvetica';
                font-size: 7.5px;
            }
            .header {
                display: inline-block;
                margin-top: 2px;
                margin-left: 2px;
            }
            caption {
                font-weight: bold;
            }
            span{
                font-weight: bold;
            }
            .description {
                font-size: 5.5px;
                float:center;
                margin-right: -24px;
                margin-left: 59px;
                margin-top: -45px;

            }
            #mayorLOGO {
                float: right;
                margin-top: -45px;
                margin-right: -95px;
                margin-left: 47px;
            }
            #sumatLOGO {
                float:left;
                margin-right: -23px;
                margin-left: 3px;
            }
            .sections {
                margin-top: 15px;
                margin-left: 5px;
                z-index: 1;
            }
            .float-container{
                padding: 20px;
            }

            .float-child {
                float: left;
                border: 1.5px solid red;
            }

            #back{
                font-size: 10px;
                width: 8.1cm;
                height:5.1cm;
                margin-left: 5px;
                margin-top: 42%;
                margin-bottom: -42%;
            }
            #front{
                width: 8.2cm;
                height:5.1cm;
                margin-bottom: -20%;
                margin-right: 0px;
                margin-left: 0px;
                margin-top: 0px;
            }

            #background {
                float: left;
                margin-top: -38%;
                margin-bottom: -35px;
                margin-left: 19%;
                margin-right: -75%;
            }
        </style>
    </head>

    <body>
        <div class="float-container">
            <div class="float-child" id="front">
                <div class="header">
                    <div class="sumatLOGO">
                        <img src="{{ asset('/assets/images/logo_sumat.png') }}" height="55px" width="55px" alt="sumatlogo"/>
                    </div>
                    <div class="description" style="text-align:center;">
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
                        <img src="{{ asset('/assets/images/logo_alcaldia.jpg') }}" height="50px" width="65px" alt="logo" />
                    </div>
                </div>
                <p id="titulo" style="text-align: center; font-weight: bold; z-index: 1;">CERTIFICADO DE SOLVENCIA DE PATENTE DE VEHÍCULO</p>
                <div class="sections">
                    <span>CONTRIBUYENTE: </span>{{ $license->taxpayer->name }}<br>
                    <span>RIF: </span>{{ $license->taxpayer->rif }}<br>
                    <span>REPRESENTANTE: </span>{{ $representation->name }}<br>
                    <span>C.I: </span>{{ $representation->document }}<br>
                    <span>PLACA: </span>{{ $vehicle->plate}}<br>
                    <span>TIPO: </span>{{ $vehicle->vehicleClassification->vehicleParameter->name}}<br>
                    <span>CLASIFICACIÓN: </span>{{ $vehicle->vehicleClassification->name }}<br>
                    <span>MARCA: </span>{{ $vehicle->vehicleModel->brand->name }}<br>
                    <span>MODELO: </span>{{ $vehicle->vehicleModel->name }}<br>
                    <span>COLOR: </span>{{ $vehicle->color->name }}

                </div>
                    <div id="background">
                        <img src="{{ asset('/assets/images/logo_sumat.png') }}" height="92px" width="190px"  style="position: absolute; z-index: -1; opacity: 0.3;"/>
                    </div>
            </div>
            <div  class="float-child">
                <div id="back">

                     <span style="font-size: 8px; margin-left: 26%;">_______________________________</span>
                     <span style="font-size: 8px; margin-left: 27%;">SUPERINTENDENTE TRIBUTARIO</span>
                    <br><br>
                    <span>PERIODO DE VIGENCIA:</span> <span style="font-weight: normal; font-size: 16px;">{{ $period }}</span>
                </div>
            </div>
        </div>
    </body>
</html>
