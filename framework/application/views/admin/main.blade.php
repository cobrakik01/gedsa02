<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Panel de Administración GEDSA</title>
        {{HTML::style('css/admin-style.css')}}
        <!-- {{HTML::style('css/jquery-ui.css')}} -->
        {{HTML::style('http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css')}}
        {{HTML::script('js/jquery-1.9.1.js')}}
        {{HTML::script('http://code.jquery.com/jquery-1.9.1.js')}}
        {{HTML::script('js/jquery-ui-1.10.3.custom.min.js')}}
        {{HTML::script('js/gedsa-lib.js')}}
        
        <link rel="shortcut icon" href="../img/logo.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="../img/logo.png" type="image/png" />
    </head>
    <body>
        <div id="logo" style="height: 100px;">
            <!-- <div style="font-size: 20px; padding-left: 50px; padding-top: 20px;">GEDSA</div> -->
            <!-- <div style="padding-bottom: 20px; padding-left: 20px;">Panel de Administración</div> -->
        </div>
        <div class="menu">
            <ul>
                @section('menu')
                <li>{{HTML::link('admin/perfil', 'Perfil de ' . @Auth::user()->nombre, array('class'=> isset($activePerfil) ? 'linkActive' : ''))}}</li>
                <li>{{HTML::link('admin/presentaciones', 'Presentaciones', array('class'=> isset($activePresentaciones) ? 'linkActive' : ''))}}</li>
                <li>{{HTML::link('admin/albumes', 'Álbumes', array('class'=> isset($activeAlbumes) ? 'linkActive' : ''))}}</li>
                <li>{{HTML::link('admin/servicios', 'Servicios', array('class'=> isset($activeServicios) ? 'linkActive' : ''))}}</li>
                <li>{{HTML::link('admin/administradores', 'Usuarios', array('class'=> isset($activeAdministradores) ? 'linkActive' : ''))}}</li>
                <li>{{HTML::link('admin/logout', 'Cerrar Sesion')}}</li>
                @yield_section
            </ul>
        </div>
        <div class="wraper">
            <div id="container">
                @yield('contenido')
            </div>
        </div>
        <div id="footer">
            Taller de Arquitectura <div style="font-weight: bold;">GEDSA</div>&copy<?php echo date('Y'); ?>
        </div>
    </body>
</html>
