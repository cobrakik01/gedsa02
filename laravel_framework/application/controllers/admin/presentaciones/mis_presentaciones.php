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
class Admin_Presentaciones_Mis_Presentaciones_Controller extends Admin_Base_Controller {

    public function get_index() {
        $control = new PresentacionController();
        $presentacion_principal = null;
        try {
            $presentaciones = $control->getListPresentaciones();
            if(PresentacionPrincipal::existe()){
                $presentacion_principal = PresentacionPrincipal::principal();
            }
        } catch (NotifierValidatorException $ex) {
            return $ex->getMessage();
        }
        return \Laravel\View::make('admin.presentaciones.mis_presentaciones')->with(array('presentaciones' => $presentaciones, 'activePresentaciones' => true, 'activeMisPresentaciones' => true, 'presentacion_principal' => $presentacion_principal));
    }

    public function get_establecer_principal() {
        try {
            $nombre = trim(base64_decode(Input::get('n')));
            $id_admin = base64_decode(Input::get('i'));

            $control = new PresentacionController();
            $presentacion = $control->buscar($nombre, $id_admin);
            PresentacionPrincipal::establecer($presentacion);
            return \Laravel\Redirect::back();
        } catch (NotifierValidatorException $ex) {
            $errors = $ex->getNotification();
            if ($errors->fails()) {
                return \Laravel\Redirect::back()->with_errors($errors);
            }
        }
    }

    public function get_remover_principal() {
        try {
            PresentacionPrincipal::remover();
            return \Laravel\Redirect::back();
        } catch (NotifierValidatorException $ex) {
            $errors = $ex->getNotification();
            if ($errors->fails()) {
                return \Laravel\Redirect::back()->with_errors($errors);
            }
        }
    }

}

?>
