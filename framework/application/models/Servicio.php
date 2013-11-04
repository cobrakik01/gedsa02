<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Servicio
 *
 * @author cobrakik
 */
class Servicio extends Eloquent {

    public static $table = "servicios";
    public static $key = 'nombre';
    public static $timestamps = true;

    public function administrador() {
        return Administrador::where('id', '=', $this->administrador_id)->first();
    }

    public function descripcion($num_chars = 100) {
        return substr($this->descripcion, 0, $num_chars);
        // terminar presentacion de descripcion con puntos suspencivos en los resultados y agregar el modulo de ver presentacion
    }

}

?>
