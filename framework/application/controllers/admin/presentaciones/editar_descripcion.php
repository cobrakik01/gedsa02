<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of editar_descripcion
 *
 * @author cobrakik
 */
class Admin_Presentaciones_Editar_Descripcion_Controller extends Admin_Base_Controller {

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
            return Laravel\View::make('admin.presentaciones.editar_descripcion')->with(array('presentacion' => $presentacion, 'activePresentaciones' => true));
        } catch (NotifierValidatorException $ex) {
            return Message::showMessage('Ocurrio un error: ' . $ex->getMessage(), 'Error');
        }
    }

    public function post_index() {
        $descripcion = trim(Input::get('descripcion'));
        $name = Input::get('name');
        $admin_id = Input::get('admin_id');
        try {
            $control = new PresentacionController();
            $control->cambiarDescripcionDePresentacion($admin_id, $name, $descripcion);
            $presentacion = $control->buscar($name, $admin_id);
            return \Laravel\Redirect::to('admin/presentaciones/ver_presentacion/?n=' . base64_encode($presentacion->nombre) . '&i=' . base64_encode($presentacion->administradores_id));
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
