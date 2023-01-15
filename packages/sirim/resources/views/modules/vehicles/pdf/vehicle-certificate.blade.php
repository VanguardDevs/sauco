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
                font-size: 9px;
            }
            .header {
                display: inline-block;
                margin-top: 14px;
                margin-left: 2px;
                margin-bottom: -25px;
            }
            caption {
                font-weight: bold;
            }
            span{
                font-weight: bold;
            }
            .description {
                font-size: 5px;
                float:center;
                margin-right: -28px;
                margin-left: 63px;
                margin-top: -45px;
                margin-bottom: -50px;

            }
            #mayorLOGO {
                float: right;
                margin-top: -41px;
                margin-right: -105px;
                margin-left: -60px;
                margin-bottom: -50px;
            }
            #sumatLOGO {
                float:left;
                margin-right: -23px;
                margin-left: 3px;
                margin-bottom: -50px;
            }
            .sections {
                margin-top: 13px;
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

            #selloVehiculo {
                float: left;
                margin-top: -38%;
                margin-bottom: -35px;
                margin-left: 4%;
                margin-right: -55%;
            }

            #firma {
                float: right;
                margin-top: 1%;
                margin-bottom: -25px;
                margin-left: -2%;
                margin-right: 0%;
                font-size: 8px;
                text-align: center;
            }

            #titulo{
                font-size: 8px;
                font-weight: bold;
                margin-left: 35%;
                margin-right: -50px;
                margin-top: -7px;
                margin-bottom: -5px;
            }
        </style>
    </head>

    <body>
        <div class="float-container">
            <div class="float-child" id="front">
                <div class="header">
                    <div class="sumatLOGO">
                        <img src="{{ asset('/assets/images/logo_sumat.png') }}" height="48px" width="50px" alt="sumatlogo"/>
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
                        <img src="{{ asset('/assets/images/logo_alcaldia.jpg') }}" height="45px" width="65px" alt="logo" />
                    </div>
                    <br>
                     <p id="titulo">CERTIFICADO DE PATENTE DE VEHÍCULO</p>
                </div>
               
                <div class="sections">
                    <span>REGISTRO Nº: </span>{{ $numVehicleCorrelative }}<br>
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

                    <div id="selloVehiculo">
                        <img src="{{ asset('/assets/images/selloVehiculo.png') }}" height="100px" width="165px" alt="logo" />
                    </div>

                     
                    <br><br>
                    <span>FACTURA Nº:</span> {{ $paymentNum }}<br>
                    <span>PERIODO DE VIGENCIA:</span> <span style="font-weight: normal; font-size: 16px; margin-right: -25%;">{{ $period }}</span>

                    <div id="firma">
                        <span style="">____________________________</span>
                        <br>
                         <span style="align-content: center;">FIRMA</span>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
