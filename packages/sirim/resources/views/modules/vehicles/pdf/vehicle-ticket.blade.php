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
                margin-top: 15px;
            }
            span{
                font-weight: bold;
            }
            .description {
                font-size: 6.3px;
                margin-left: 19px;
                margin-bottom: 10px;
                margin-right: -10px;
                margin-top: 2px;
                float:center;
                top: -30px;
            }
            #mayorLOGO {
                float: right;
                margin-top: -5px;
                margin-right: -10px;
                margin-left: -20px;
            }
            #sumatLOGO {
                float:left;
                margin-top: 30px;
                margin-left: -40px;
                margin-right: 0px;
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
                SUPERINTENDENCIA MUNICIPAL DE ADMINISTRACIÓN TRIBUTARIA<br>
                RIF: G-20000222-1<br>
                DIRECCIÓN: AV. CARABOBO, EDIFICIO MUNICIPAL
                </p>
            </div>
            <div id="mayorLOGO">
                <img src="{{ asset('/assets/images/logo_alcaldia.jpg') }}" height="50px" width="65px" alt="logo" />
            </div>
        </div>
        <br><br><br>
        <div class="sections">
            <p style="text-align: center; font-weight: bold;">DATOS GENERALES DEL CONTRIBUYENTE</p>
            <p>
            <span>RIF:</span> {{ $license->taxpayer->rif }}<br>
            <span>NOMBRE: </span>{{ $license->taxpayer->name }}<br>
            <span>DIRECCIÓN: </span>{{ $license->taxpayer->fiscal_address }}<br>
            </p>
        </div>
        <div class="sections">
        <p style="text-align: center; font-weight: bold;">DETALLES DEL VEHÍCULO</p>
            <span>PLACA: </span>{{ $vehicle->plate}}<br>
            <span>SERIAL DE CARROCERÍA: </span>{{ $vehicle->body_serial}}<br>
            <span>SERIAL DE MOTOR: </span>{{ $vehicle->engine_serial}}<br>
            <span>PARÁMETRO DEL VEHÍCULO: </span>{{ $vehicle->vehicleClassification->vehicle_parameter->name}}<br>
            <span>CLASIFICACIÓN DEL VEHÍCULO: </span>{{ $vehicle->vehicleClassification->name }}<br>
            <span>MODELO DEL VEHÍCULO: </span>{{ $vehicle->vehicleModel->name }}<br>

            </p>
        </div>
        <div class="sections">
            <span>COLOR: </span>{{ $vehicle->color->name }}<br><br>

            @if($license->correlative->correlative_type_id == 1)
                <span>PERIODO DE VIGENCIA:</span> {{ $period }}<br>
            @else
                <span>PERIODO DE RENOVACIÓN:</span> {{ $period }}<br>
            @endif
                <span>FECHA DE VENCIMIENTO:</span> {{ $license->expiration_date }}


        </div>
    </body>
</html>
