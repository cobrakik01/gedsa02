<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Admin {

    public static function controllers() {
        /**
         * Normal
         */
        Router::controller('admin.home');
        Router::controller('admin.perfil');
        Router::controller('admin.albumes');
        Router::controller('admin.servicios');
        
        Router::controller('admin.presentaciones.home');
        Router::controller('admin.presentaciones.nueva_presentacion');
        Router::controller('admin.presentaciones.mis_presentaciones');
        Router::controller('admin.presentaciones.buscar_presentacion');
        Router::controller('admin.presentaciones.ver_presentacion');
        Router::controller('admin.presentaciones.editar_nombre');
        Router::controller('admin.presentaciones.editar_descripcion');
        Router::controller('admin.presentaciones.eliminar_presentacion');
        
        Router::controller('admin.login');
        Router::controller('admin.logout');
        Router::controller('admin.administradores');
        
        /*
         * Ajax
         */
        Router::controller('admin.presentaciones.ajax');
        Router::controller('admin.albumes_ajax');
    }

}

?>
