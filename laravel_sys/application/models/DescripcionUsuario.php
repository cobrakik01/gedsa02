<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DescripcionUsuario
 *
 * @author cobrakik
 */
class DescripcionUsuario extends Eloquent {

    public static $table = "descripcion_usuarios";
    public static $timestamps = true;

    public function administrador() {
        return Administrador::where('descripcion_usuarios_id', '=', $this->id)->first();
        //return $this->has_one('Administrador'); // indica que la clave foranea de esta tabla se encuentra dentro de Administrador
    }

}

?>
