<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mis_presentaciones
 *
 * @author cobrakik
 */
class Admin_Presentaciones_Eliminar_Presentacion_Controller extends Admin_Base_Controller {

    public function get_index() {
        $nombre = base64_decode(Input::get('n'));
        $id_admin = base64_decode(Input::get('i'));
        try {
            $control = new PresentacionController();
            $control->eliminarPresentacion($id_admin, $nombre);
        } catch (NotifierValidatorException $ex) {
            $error = $ex->getNotification();
            if ($error->fails()) {
                return Message::showMessage($ex->getMessage(), 'Advertencia');
            }
        }
        return \Laravel\Redirect::back();
    }

}

?>
