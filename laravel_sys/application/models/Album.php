<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Album extends Eloquent {

    public static $table = "albums";
    public static $timestamps = true;

    public function get_dir() {
        $dir = Format::textToDirFormat($this->nombre);
        return empty($dir) ? '?dir=' . $this->url : $dir;
    }

    public function administrador() {
        return Administrador::where('id', '=', $this->administradores_id)->first();
        //return $this->belongs_to('DescripcionUsuario'); // indica que contiene la clave foranea de la tabla DescripcionUsuario
    }

    public function fotos($fotos_por_pagina = 10) {
        return Foto::where('albums_id', '=', $this->id)->paginate($fotos_por_pagina);
        //return $this->belongs_to('DescripcionUsuario'); // indica que contiene la clave foranea de la tabla DescripcionUsuario
    }

    public function num_fotos() {
        return Foto::where('albums_id', '=', $this->id)->count();
    }

    /**
     * Elimina todas las fotos relacionadas con el album
     * @return int Retorna el numero de fotos eliminadas
     */
    public function delete_all_photos() {
        return Foto::where('albums_id', '=', $this->id)->delete();
    }

    public function num_photos() {
        return Foto::where('albums_id', '=', $this->id)->count();
    }
    
    public function vacio(){
        return $this->num_fotos() == 0;
    }

}

?>
