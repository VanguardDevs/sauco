<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!-- CSRF Token -->
        <title> Comprobante Liquidación</title>
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
                text-align: center;
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
            .tables {
                display:block;
                margin-top: 25px;
            }
            #user {
                font-weight: bold;
            }
            .user-info {
                float: left;
                width: 50%;
                font-size: 16px;
            }
            caption {
                font-weight: bold;
                margin-bottom: 20px;
            }
            th {
                font-size: 10px;
                padding: 3px 1px;
            }
        </style>
    </head>

    <body>
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
        <div class="tables">

           <table class="details">
                <caption>COMPROBANTE DE LIQUIDACIÓN</caption>
                <thead>
                  <tr>
                    <th width="15%">Nº LIQUIDACIÓN</th>
                    <th width="60%">MONTO</th>
                    <th width="25%">FECHA</th>

                  </tr>
                </thead>
                <tbody>
                 <tr>
                    <td>{{ $liquidation->num }}</td>
                    <td style="word-spacing:1px;font-size:16px;">{{ $liquidation->pretty_amount }}</td>
                    <td >{{ $liquidation->created_at }}</td>
                </tr>
             </table>
        </div>
        <br>
        <div class="miscellaneus">
            <div class="user-info">
                <span id="user">Usuario:</span> {{ $liquidation->liquidable->user->full_name }}
            </div>

        </div>
    </body>
</html>
