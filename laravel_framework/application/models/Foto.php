<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Foto
 *
 * @author cobrakik
 */
class Foto extends Eloquent {

    public static $table = "fotos";
    public static $timestamps = true;

    public function administrador() {
        return Administrador::where('id', '=', $this->administradores_id)->first();
        //return $this->belongs_to('DescripcionUsuario'); // indica que contiene la clave foranea de la tabla DescripcionUsuario
    }

    public function album() {
        return Album::where('id', '=', $this->albums_id)->first();
        //return $this->belongs_to('DescripcionUsuario'); // indica que contiene la clave foranea de la tabla DescripcionUsuario
    }

    public function shortName($length = 17) {
        return (strlen($this->nombre) < $length) ? $this->nombre : substr($this->nombre, 0, $length) . ' ... .' . Laravel\File::extension($this->nombre);
    }

    public function shortDescription($length = 17) {
        return Format::shortText($this->descripcion, $length);
    }

    public function getExtension() {
        return Laravel\File::extension($this->url);
    }

    public function getPath() {
        return $this->url;
    }

    public function getRealName() {
        return $this->nombre;
    }

    public function getSimpleName() {
        $simple_name = "";
        $ext = $this->getExtension();
        if (strlen($ext) > 0) {
            $ext = '.' . $this->getExtension();
        }
        if (ends_with($this->nombre, $ext)) {
            $simple_name = substr($this->nombre, 0, strlen($this->nombre) - strlen($ext));
        } else {
            $simple_name = $this->nombre;
        }
        return $simple_name;
    }

    public static function find_by_name($nombre) {
        return Foto::where('nombre', 'like', $nombre . '%')->first();
    }

    public function presentaciones() {
        return Presentacion::join('presentaciones_has_fotos', 'presentaciones_has_fotos.presentacion_administrador_id', '=', 'presentaciones.administradores_id')->paginate();
    }

}

?>
