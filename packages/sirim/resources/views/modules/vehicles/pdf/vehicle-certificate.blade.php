<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!-- CSRF Token -->
        <title> Certificado de Vehículo </title>
        <style>
            @page {
                margin-left: 6.5cm;
                
                margin-bottom: 23.3cm;
            }

           body {
                font-family: 'Helvetica';
                font-size: 7.5px;
                float:center;
                border-color: red;
                border-width: 1.5px;
                border-style: solid;
                width: 8.1cm;
                height: 5cm;
            }
            .header {
                position: relative;
                display: block;
            }
            .header div {
                display: inline-block;
                text-align:center;
                margin-top: 1px;
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
                margin-left: 60px;
                margin-top: -33px;
                float:center;
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
                margin-left: -47px;
                margin-right: -36px;
            }
            #titulo{
                margin-top: 8px;
                margin-bottom: 13px;
            }
        </style>
    </head>

    <body>
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
    </body>
</html>
