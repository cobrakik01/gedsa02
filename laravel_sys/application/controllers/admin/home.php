<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin
 *
 * @author cobrakik
 */
class Admin_Home_Controller extends Admin_Base_Controller {

    public function get_index() {
        return Laravel\Redirect::to('admin/perfil');
    }

}

?>
