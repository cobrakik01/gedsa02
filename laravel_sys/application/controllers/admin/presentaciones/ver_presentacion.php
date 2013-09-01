<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ver_presentacion
 *
 * @author cobrakik
 */
class Admin_Presentaciones_Ver_Presentacion_Controller extends Admin_Base_Controller {

    public function get_index() {
        $nombre = base64_decode(Input::get('n'));
        $id_admin = base64_decode(Input::get('i'));
        try {
            $control = new PresentacionController();
            $presentacion = $control->getPresentacion($id_admin, $nombre);
            $fotos = $presentacion->fotos();
            return Laravel\View::make('admin.presentaciones.ver_presentacion')->with(array('presentacion' => $presentacion, 'fotos' => $fotos, 'activePresentaciones' => true));
        } catch (NotifierValidatorException $ex) {
            $error = $ex->getNotification();
            if ($error->fails()) {
                return Message::showMessage($ex->getMessage(), 'Advertencia');
            }
        }
    }

    public function get_eliminar_foto() {
        $presentacion_nombre = base64_decode(Input::get('pnom'));
        $foto_id = base64_decode(Input::get('fid'));

        try {
            $control = new PresentacionController();
            $control->eliminarFotoDePresentacionPorId($presentacion_nombre, $foto_id);
            return Laravel\Redirect::back();
        } catch (NotifierValidatorException $ex) {
            $error = $ex->getNotification();
            if ($error->fails()) {
                return Message::showMessage($ex->getMessage(), 'Advertencia');
            }
        }
    }

}

?>
