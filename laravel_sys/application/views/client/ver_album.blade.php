<!DOCTYPE html>
<html><!-- HEADER -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Taller de Arquitectura Gedsa</title>
        {{HTML::style('css/client-style.css')}}

        {{HTML::script('js/jquery-1.9.1.js')}}
        {{HTML::script('js/imageViewer.js')}}

        <link rel="shortcut icon" href="/img/logo.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="/img/logo.png" type="image/png" />

    </head>

    <body style="background-color: #636363;">
        <div class="iv-slide" id='{{base64_encode($id)}}'>
        </div>
        <div class="imageViewer">
            <div>
                <img src="/img/loader.gif" />
                <div id="descripcion-foto" style="padding: 10px; position: relative;">
                </div>
            </div>
        </div>
    </body>
</html>