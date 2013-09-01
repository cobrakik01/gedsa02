<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of logout
 *
 * @author cobrakik
 */
class Admin_Login_Controller extends Base_Controller {

    public function get_index() {
        return View::make('admin.login');
    }

    public function post_index() {
        $us = Administrador::where('nombre', '=', trim(Input::get('txtNombreUsuario')))->first();
        if ($us && $us->password == Input::get('txtPassword') && $us->activo) {
            Auth::login($us);
            return Redirect::to('admin');
        } else {
            return Laravel\Redirect::back()->with_errors(NotifierValidator::createError('El usuario es incorrecto'));
        }
    }

}

?>
