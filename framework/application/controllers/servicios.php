<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Servicios_Controller extends Base_Controller {

    public function get_index() {
        $control = new ServicioController();
        $servicios = $control->todos(3);
        return View::make('client.servicios')->with(array('servicios' => $servicios));
    }

    public function get_ver($nombre_servicio_encode = "") {
        if($nombre_servicio_encode == ""){
            return \Laravel\Redirect::back()->with_errors(NotifierValidator::createError('No se encontro el servicio solicitado.'));
        }
        
        $nombre_servicio = base64_decode($nombre_servicio_encode);
        $control = new ServicioController();

        $servicio = $control->buscarServicioPorNombre($nombre_servicio);
        if (is_null($servicio)) {
            return \Laravel\Redirect::back()->with_errors(NotifierValidator::createError('No se encontro el servicio solicitado.'));
        }

        return View::make('client.ver_servicio')->with(array('servicio' => $servicio));
    }

}

?>
