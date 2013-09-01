<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of presentaciones_admin
 *
 * @author cobrakik
 */
class Admin_Presentaciones_Ajax_Controller extends Admin_Base_Controller {

    public function get_index() {
        return "No tienes los premisos suficientes para visualizar esta pagina";
    }

    public function post_nuevo() {
        $nombre = Input::get('nombre');
        $fotosId = Input::get('fotosId');
        $control = new PresentacionController();
        $control->nuevaPresentacion($nombre, $fotosId);
    }

    public function get_load() {
        $controlador = new AlbumController();
        $albumes = $controlador->todosLosAlbums();
        return \Laravel\View::make('admin.presentaciones.nueva_presentacion')->with(array('activePresentaciones' => true, 'activeNuevo' => true, 'albumes' => $albumes));
    }

    public function post_agregar() {
        $nombre = trim(base64_decode(Input::get('nombreEncode')));
        $idAdmin = trim(base64_decode(Input::get('idAdminEncode')));
        $fotosId = Input::get('fotosId');
        
        $control = new PresentacionController();
        $control->agregarFotos($nombre, $idAdmin, $fotosId);
    }

}

?>
