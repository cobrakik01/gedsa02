<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminPerfil
 *
 * @author cobrakik
 */
class Admin_Perfil_Controller extends Admin_Base_Controller {

    public function get_index() {
        $user = Auth::user();
        $us_desc = $user->descripcion();
        return View::make('admin.perfil')->with(array('user' => $user, 'us_desc' => $us_desc, 'activePerfil' => true));
    }

}

?>
