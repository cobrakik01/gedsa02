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
class Admin_Logout_Controller extends Base_Controller {

    public function get_index() {
        Auth::logout();
        return Laravel\Redirect::to('admin/login');
    }

}

?>
