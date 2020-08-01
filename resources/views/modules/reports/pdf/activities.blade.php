<!DOCTYPE html>

@php
ini_set('memory_limit', "800M");
ini_set('max_execution_time', "800");
@endphp

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!-- CSRF Token -->
        <title> Actividades Económicas Registradas </title>
        <style>
           body {
                font-family: sans-serif, serif;
                font-size: 14px;
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
            }
            table, td, th {
                border: 1px #000 solid;
            }
            td {
                font-size: 11px;
                padding: 4px;
            }
            table {
                border-collapse: collapse;
                width: 100%;                
                margin-top: 5px;
            }
            .bill-info {
                width: 100%;
                clear: both;
                font-weight: bold;
            }
            .col-bill-info {
                float: left;
                width: 50%;
            }
            .total-amount {
                text-align: right;
            }
            .miscellaneus {
                font-size: 10px;
            }
            caption {
                font-weight: bold;
            }
        </style>
    </head>

    <body>
        <div class="header">
            <div class="sumatLOGO">
                <img src="{{ base_path().'/public/assets/images/sumat.png' }}" height="90px" width="230px" alt="sumatlogo"/>
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
                <img src="{{ base_path().'/public/assets/images/logo.png' }}" height="70px" width="130px" alt="logo" />
            </div>
        </div>
   	<table style="text-align: left">
	<caption>ACTIVIDADES ECONÓMICAS</caption>
	<thead>
	  <tr>
	    <th width="10%">CÓDIGO</th>
	    <th width="70%">NOMBRE</th>
	    <th width="10%">ALÍCUOTA</th>
	    <th width="10%">MÍNIMO TRIBUTABLE</th>
	  </tr>
	</thead>
	<tbody>
	@foreach($activities as $activity)
	 <tr>
	    <td>{{ $activity->code }}</td> 
	    <td>{{ $activity->name }}</td>   
	    <td>{{ $activity->aliquote }}</td>
	    <td>{{ $activity->min_tax }}</td>
	</tr>
	@endforeach   
     </table>
    <br>
    <div class="bill-info">
	<div class="col-bill-info">
	    FECHA DE EMISIÓN: {{ $emissionDate }}
	</div>
	<div class="col-bill-info">
	    <div class="total-amount">
		TOTAL: {{ $total }}
	    </div>
	</div>
    </div>
    </body>
</html>
