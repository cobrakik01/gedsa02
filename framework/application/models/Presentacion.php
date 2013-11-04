<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Presentacion
 *
 * @author cobrakik
 */
class Presentacion extends Eloquent {

    public static $table = "presentaciones";
    public static $key = 'nombre';
    public static $timestamps = true;

    public function fotos() {
        $f = $this->has_many_and_belongs_to('Foto', 'presentaciones_has_fotos', 'presentacion_nombre')->paginate();
        return $f;
    }

    public function administrador() {
        return Administrador::find($this->administradores_id);
    }

}

?>
