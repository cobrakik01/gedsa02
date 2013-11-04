<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of presentaciones_admin
 *
 * @author cobrakik
 */
class Admin_Presentaciones_Home_Controller extends Admin_Base_Controller {

    public function get_index() {
        return Laravel\Redirect::to('admin/presentaciones/mis_presentaciones');
    }

}

?>
