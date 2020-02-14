<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!-- CSRF Token -->

    <style>
      p {
        font-weight: bold;
      }

      td {
        padding: 5px;
      }

      input {
        border: 1px solid #B4B3B2;
        font-size: 13px;
      }

      #footer {
        bottom: 0px;
        text-align: center;
        font-size: 10px;
        margin-top: 70px;
      }

    </style>
</head>

<body>
  <div id="header">
    <table width="100%">
      <tr>
        <td><img src="{{ asset('assets/images/escudo.jpg') }}" alt="" style="width: 80px;"></td>
        <td style="text-align: center;">
          REPUBLICA BOLIVARIANA DE VENEZUELA <br>
          ALCALDIA DEL MUNICIPIO BERMUDEZ <br>
          CARUPANO - ESTADO SUCRE <br>
          SUPERINTENDENCIA MUNICIPAL DE ADMINISTRACIÓN TRIBUTARIA <br><br>
          <p>EJEMPLO DE LICENCIA</p>
        </td>
        <td><img src="{{ asset('assets/images/logo1.png') }}" alt="" style="width: 90px; margin-left: 90px;"></td>
      </tr>
    </table>
  </div>
  <div id="footer">
    LICDO. IVÁN VENALES <br>
    SUPERINTENTENDENTE DE ADMINISTRACIÓN TRIBUTARIA <br>
    RESOLUCION NRO XXXXX, FECHA 28-12-18 <br>
  </div>
</body>
</html>
