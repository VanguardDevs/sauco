<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!-- CSRF Token -->
        <title>Comprobante de declaración de actividad económica</title>
        <style>
           body {
                font-family: 'Helvetica';
                font-size: 9px;
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
            .details td {
                text-align: center;
            }
            .details .object-payment {
                text-align: left;
                padding-left: 3px;
            }
            .tables {
                display:block;
            }
            .bill-info {
                width: 100%;
                clear: both;
                font-weight: bold;
            }

            .total-amount {
                text-align: right;
            }
            .sections {
                font-size: 9px;
            }
            span{
                font-weight: bold;
            }
        </style>
    </head>

    <body>
        <div class="header">
            <div class="description">
               <p>
                ALCALDÍA DEL MUNICIPIO BERMÚDEZ<br>
                SUPERINTENDENCIA MUNICIPAL DE ADMINISTRACIÓN TRIBUTARIA<br>
                RIF: G-20000222-1<br>
                DIRECCIÓN: AV. CARABOBO, EDIFICIO MUNICIPAL
                </p>
            </div>
        </div>
        <br>
        <span>N° DE DECLARACIÓN:</span> {{ $affidavit->num }}
        <div class="sections">
            <p>
            <span>DATOS GENERALES DEL CONTRIBUYENTE</span><br>
            NOMBRE: {{ $affidavit->taxpayer->name }}<br>
            RIF: {{ $affidavit->taxpayer->rif }}<br>
            DIRECCIÓN: {{ $affidavit->taxpayer->fiscal_address }}<br>
            </p>
        </div>



        <div class="sections">

            <span>DECLARACIONES POR ACTIVIDAD ECONÓMICA</span>
            @foreach($affidavit->economicActivityAffidavits as $EconomicActivity)
            CÓDIGO: {{ $EconomicActivity->economicActivity->code }}<br>
            NOMBRE DE LA ACTIVIDAD: {{$EconomicActivity->economicActivity->name}}<br>
            DECLARADO: {{ $EconomicActivity->affidavit_amount }}<br>
            CALCULADO: {{ $EconomicActivity->calc }}<br><br>
            @endforeach

        </div>

        <div class="sections">
             <span>MONTO TOTAL DECLARADO:</span> {{ $affidavit->prettyTotalBruteAmount }} Bs<br>
             <span>MONTO TOTAL CALCULADO:</span> {{ $affidavit->prettyTotalCalcAmount }} Bs<br>

           <br>

            <span>FECHA:</span> {{ $affidavit->processed_at }}<br>
            <span>USUARIO:</span> {{ $affidavit->user->full_name }}<br>

        </div>


    </body>
</html>
