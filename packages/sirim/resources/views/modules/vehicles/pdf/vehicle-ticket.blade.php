<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!-- CSRF Token -->
        <title> Comprobante de Vehículo </title>
        <style>
            @page {
                margin-left: 12px;
                margin-right: 12px;
                margin-top: 12px;
                margin-bottom: 12px;
            }
           body {
                font-family: 'Helvetica';
                font-size: 10px;
            }
            .header {
                position: relative;
                display: block;
            }
            .header div {
                display: inline-block;
                text-align:center;
            }
            caption {
                font-weight: bold;
            }
            .sections {
                margin-top: -5px;
                border-color: red;
                border-width: 1.5px;
                border-style: solid;
            }
            span{
                font-weight: bold;
            }
            .description {
                font-size: 6.3px;
                margin-left: 36px;
                margin-bottom: 10px;
                margin-right: -19px;
                margin-left: 55.3px;
                margin-top: -3px;
                float:center;
                top: -30px;
            }
            #mayorLOGO {
                float: right;
                margin-top: -5px;
                margin-right: -10px;
                margin-left: -40px;
            }
            #sumatLOGO {
                float:left;
                margin-top: 30px;
                margin-left: -40px;
                margin-right: -30px;
            }
        </style>
    </head>

    <body>
        <div class="header">
            <div class="sumatLOGO">
                <img src="{{ asset('/assets/images/logo_sumat.png') }}" height="50px" width="55px" alt="sumatlogo"/>
            </div>
            <div class="description">
               <p>
                REPÚBLICA BOLIVARIANA DE VENEZUELA<br>
                ESTADO SUCRE<br>
                ALCALDÍA DEL MUNICIPIO BERMÚDEZ<br>
                SUPERINTENDENCIA MUNICIPAL DE ADMINISTRACIÓN<br>
                TRIBUTARIA<br>
                RIF: G-20000222-1<br>
                DIRECCIÓN: AV. CARABOBO, EDIFICIO MUNICIPAL
                </p>
            </div>
            <div id="mayorLOGO">
                <img src="{{ asset('/assets/images/logo_alcaldia.jpg') }}" height="50px" width="65px" alt="logo" />
            </div>
        </div>
        <br>
        <p style="text-align: center; font-weight: bold;">DATOS GENERALES DEL CONTRIBUYENTE</p>
        <div class="sections">
                <span>RIF:</span> {{ $license->taxpayer->rif }}<br>
                <span>NOMBRE: </span>{{ $license->taxpayer->name }}<br>
                <span>DIRECCIÓN: </span>{{ $license->taxpayer->fiscal_address }}<br>
                <span>REPRESENTANTE: </span>{{ $representation->name }}<br>
                <span>C.I: </span>{{ $representation->document }}<br>
        </div>
        <br>
        <p style="text-align: center; font-weight: bold;">DETALLES DEL VEHÍCULO</p>
        <div class="sections">
            <span>PLACA: </span>{{ $vehicle->plate}}<br>
            <span>PARÁMETRO DEL VEHÍCULO: </span>{{ $vehicle->vehicleClassification->vehicleParameter->name}}<br>
            <span>CLASIFICACIÓN DEL VEHÍCULO: </span>{{ $vehicle->vehicleClassification->name }}<br>
            <span>MODELO DEL VEHÍCULO: </span>{{ $vehicle->vehicleModel->name }}<br>
            <span>MARCA DEL VEHÍCULO: </span>{{ $vehicle->vehicleModel->brand->name }}<br>
            <span>COLOR: </span>{{ $vehicle->color->name }}

        </div>
        <br>
        <div>
            <span>PERIODO DE VIGENCIA:</span> {{ $period }}<br>
        </div>
    </body>
</html>
