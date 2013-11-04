<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of nueva_presentacion
 *
 * @author cobrakik
 */
class Admin_Presentaciones_Nueva_Presentacion_Controller extends Admin_Base_Controller {

    public function get_index() {
        $controlador = new AlbumController();
        $albumes = $controlador->todosLosAlbums();
        return \Laravel\View::make('admin.presentaciones.nueva_presentacion')->with(array('activePresentaciones' => true, 'activeNuevo' => true, 'albumes' => $albumes));
    }

}

?>
