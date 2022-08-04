<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!-- CSRF Token -->
        <title> Certificado de Vehículo </title>
        <style>
            @page {
                margin-left: 1.5cm;
                margin-bottom: 20cm;
            }

            .float-container {
                padding: 20px;
            }

            .float-child {
                float: left;
                padding: 20px;

                border: 1.5px solid red;
            }

           body {
                font-family: 'Helvetica';
                font-size: 7.5px;
            }
            .header {
                position: relative;
                display: block;
            }
            .header div {
                display: inline-block;
                text-align:center;
                margin-top: -10px;
                margin-left: -10px;
            }
            caption {
                font-weight: bold;
            }
            .sections {
                margin-top: -5px;
                margin-left: 2px;
            }
            span{
                font-weight: bold;
            }
            .description {
                font-size: 5.5px;
                margin-bottom: 10px;
                margin-right: -20px;
                margin-left: 90px;
                margin-top: -73px;
                float:left;
                top: -30px;
            }
            #mayorLOGO {
                float: right;
                margin-top: 1px;
                margin-right: -1.5px;
                margin-left: -75px;
            }
            #sumatLOGO {
                float:left;
                margin-left: -97px;
                margin-right: 36px;
            }
            #titulo{
                margin-top: 8px;
                margin-bottom: 13px;
            }
            .float-container{
                margin-bottom: 0px;
                margin-right: 0px;
                margin-left: 0px;
                margin-top: 0px;
                border: 1.5px solid red;
            }
            #back{
                width: 7cm;
                height:4.6cm
            }
            #front{
                width: 7cm;
                margin-bottom: 0px;
                margin-right: 0px;
                margin-left: -10px;
                margin-top: 0px;
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
                        <img src="{{ asset('/assets/images/logo_alcaldia.jpg') }}" height="50px" width="65px" alt="logo" />
                    </div>
                </div>
                <p id="titulo" style="text-align: center; font-weight: bold;">CERTIFICADO DE PATENTE DE VEHÍCULO</p>
                <div class="sections">
                    <span>REPRESENTANTE: </span>{{ $representation->name }}<br>
                    <span>C.I: </span>{{ $representation->document }}<br>
                    <span>PLACA: </span>{{ $vehicle->plate}}<br>
                    <span>TIPO: </span>{{ $vehicle->vehicleClassification->vehicleParameter->name}}<br>
                    <span>CLASIFICACIÓN: </span>{{ $vehicle->vehicleClassification->name }}<br>
                    <span>MARCA: </span>{{ $vehicle->vehicleModel->brand->name }}<br>
                    <span>MODELO: </span>{{ $vehicle->vehicleModel->name }}<br>
                    <span>COLOR: </span>{{ $vehicle->color->name }}
                    <br><br>
                    <span>PERIODO DE VIGENCIA:</span> {{ $period }}
                </div>
            </div>
            <div  class="float-child">
                <div id="back">
                    <br><br><br>
                    <span>PERIODO DE VIGENCIA:</span> {{ $period }}
                </div>
            </div>
        </div>
    </body>
</html>
