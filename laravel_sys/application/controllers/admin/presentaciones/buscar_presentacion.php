<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of buscar_presentacion
 *
 * @author cobrakik
 */
class Admin_Presentaciones_Buscar_Presentacion_Controller extends Admin_Base_Controller {

    public function get_index() {
        $nombre_presentacion = trim(Input::get('txtBuscar'));
        $control = new PresentacionController();
        $presentaciones = $control->buscarPresentaciones($nombre_presentacion);
        return View::make('admin.presentaciones.buscar_presentacion')->with(array('activeBuscar' => true, 'presentaciones' => $presentaciones));
    }
}

?>
