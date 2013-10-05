<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Taller de arquitectura GEDSA</title>
        <style type="text/css">
            body {
                margin: 0px;
                padding: 0px;
                font-family: Geneva, sans-serif;
                text-shadow: 1px 1px 1px #cccccc;
                background-color: #333333;
            }
            .wrapper {
                width: 90%;
                min-width: 800px;
                margin: 0 auto;
                overflow: hidden;

            }

            #header {
                background-color: #ffffff;
                background-image: url(img/fondo-cabecera.png);
            }

            small {
                color: #999999;
            }
        </style>
    </head>
    <body>
        <div id="header">
            <div class="wrapper">
                {{HTML::image('img/logo.png', '', array('style'=>'float: left;'))}}
                <div style="float: left;">
                    <h1 style="margin: 0px; margin-top: 20px;">GEDSA</h1>
                    <small><em>Taller de arquitectura</em></small>
                </div>
                <h1 style="float: left; font-size: 40px; font-weight: lighter; margin-left: 10%; margin-top: 5%;">
                    Plasmamos tus sueños
                </h1>
            </div>
        </div>
        <div style="color: #f4f4f4; border-top: #c5bd6c solid 5px;">
            <div class="wrapper" style="padding: 20px; background-color: #f9f9f9; border-radius: 3px; margin-top: 10px; color: #7e7e7e;">
                <h2>Teiene una nueva solicitud</h2>

                <table width='100%' border='0' style="text-shadow: none;">
                    <tr>
                        <td width='150px'>Nombre</td>
                        <td>{{$txtNombre}}</td>
                        <td align='center'>Descripcion de la solicitud</td>
                    </tr>
                    <tr>
                        <td>Apellido Paterno</td>
                        <td>{{$txtApp}}</td>
                        <td rowspan="5" style="vertical-align: top;">{{$txtDescripcionSolicitud}}</td>
                    </tr>
                    <tr>
                        <td>Apellido Materno</td>
                        <td>{{$txtApm}}</td>
                    </tr>
                    <tr>
                        <td>Direccion</td>
                        <td>{{$txtDireccion}}</td>
                    </tr>
                    <tr>
                        <td>Telefono</td>
                        <td>{{$txtTelefono}}</td>
                    </tr>
                    <tr>
                        <td>Correo Electronico</td>
                        <td>{{$txtEmail}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>
