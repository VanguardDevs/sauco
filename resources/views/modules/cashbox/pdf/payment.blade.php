<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!-- CSRF Token -->
        <title> Factura </title>
        <style>
            .left {
                float: right;
            }
            body {
                font-family: 'Arial';
                font-size: 14px;
            }
            .header {
                width: 100%;
                font-size: 8px;
            }
            .footer {
                padding: 0;
                box-sizing: content-box;
            }
            .header, .footer {
                position: relative;
                display:block;
            }
            .header div, .footer div {
                display: inline-block;
            }
            #mayorLOGO {
                float: right;
            }
            tr, td, th {
                border: 1px #000 solid;
            }
            td, td, th, tr {
                margin: 0;
                border-collapse: collapse;
            }
            td {
                font-size: 12px;
            }
            table {
                width: 100%;
            }
            .total {
                float: right;
            }
            .tables {
                display:block;
            }
            .bill-num {
                padding-left: 5px;
                box-sizing: content-box;
                width: 60%;
                font-weight: bold;
            } 
            .total {
                width:37%;
                float: right;
                padding-left: 0;
            }
            .table-title {
                text-align: center;
                font-weight: bold;
            }
        </style>
    </head>

    <body>
        <div class="header">
            <div class="sumatLOGO">
                <img src="{{ asset('assets/images/sumat.png') }}" height="80px" width="210px" alt="sumatlogo"/>
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
                <img src="{{ asset('assets/images/logo.png') }}" height="65px" width="120px" alt="logo" />
            </div>
        </div>
        <div class="tables">
             <table class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                  <tr>
                    <th width="80%">RAZÓN SOCIAL O DENOMINACIÓN COMERCIAL</th>
                    <th width="20%">RIF</th>
                  </tr>
                </thead>
                <tbody>
                     <tr>
                        <td>{{ $denomination }}</td> 
                        <td>{{ $taxpayer->rif }}</td>
                    </tr>
                </tbody>
             </table>
            <div class="table-title">
                OBJETO DE PAGO
            </div>
            <table class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                  <tr>
                    <th width="20%">FECHA</th>
                    <th width="60%">FORMA DE PAGO</th>
                    <th width="20%">REFERENCIA</th>
                  </tr>
                </thead>
                <tbody>
                     <tr>
                        <td>{{ $payment->updated_at }}</td> 
                        <td>{{ $payment->paymentMethod->name }}</td>   
                        <td>{{ $reference }}</td>
                    </tr>
                </tbody>
             </table>
            <div class="table-title">
               DETALLES DEL PAGO 
            </div>
            <table class="" style="text-align: center">
                <thead>
                  <tr>
                    <th width="20%">NO. LIQUIDACIÓN</th>
                    <th width="60%">DETALLES</th>
                    <th width="20%">MONTO TOTAL</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($payment->receivables as $receivable)
                 <tr>
                    <td>{{ $receivable->id }}</td> 
                    <td>{{ $receivable->object_payment  }}</td>   
                    <td>{{ $receivable->settlement->amount }}</td>
                </tr>
                @endforeach   
             </table>
            <br>
            <div class="footer">
                <div class="bill-num">
                    N° DE FACTURA: {{ $billNum }}
                </div>
                <div class="total">PAGO TOTAL: {{ $payment->amount }}</div>
        </div>
    </body>
</html>
