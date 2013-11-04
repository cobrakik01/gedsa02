<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Client {

    public static function controllers() {
        Route::controller('home');
        Route::controller('servicios');
        Route::controller('trabajos');
        Route::controller('nosotros');
        Route::controller('contactanos');
        Route::controller('image');
    }

}

?>
