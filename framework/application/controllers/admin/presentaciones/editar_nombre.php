<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of editar_nombre
 *
 * @author cobrakik
 */
class Admin_Presentaciones_Editar_Nombre_Controller extends Admin_Base_Controller {

    public function get_index() {
        try {
            $nombre_encode = Input::get('n');
            $admin_id_encode = Input::get('i');
            if ($nombre_encode == "" || $admin_id_encode == -1) {
                return Message::showMessage('Esta pagina no esta disponible', 'Advertencia');
            }
            $control = new PresentacionController();
            $nombre = base64_decode($nombre_encode);
            $admin_id = base64_decode($admin_id_encode);

            $presentacion = $control->buscar($nombre, $admin_id);
            return Laravel\View::make('admin.presentaciones.editar_nombre')->with(array('presentacion' => $presentacion, 'activePresentaciones' => true));
        } catch (NotifierValidatorException $ex) {
            return Message::showMessage('Ocurrio un error: ' . $ex->getMessage(), 'Error');
        }
    }

    public function post_index() {
        $new_name = trim(Input::get('new_name'));
        $old_name = Input::get('old_name');
        $admin_id = Input::get('admin_id');
        try {
            $control = new PresentacionController();
            $control->cambiarNombrePresentacion($admin_id, $old_name, $new_name);
            return \Laravel\Redirect::to('admin/presentaciones/ver_presentacion/?n=' . base64_encode($new_name) . '&i=' . base64_encode($admin_id));
        } catch (NotifierValidatorException $ex) {
            $error = $ex->getNotification();
            if ($error->fails()) {
                return \Laravel\Redirect::back()->with_errors($error);
            }
            return Message::showMessage('Ocurrio un error: ' . $ex->getMessage(), 'Error');
        }
    }

}

?>
