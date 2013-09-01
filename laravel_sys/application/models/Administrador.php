<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Administrador
 *
 * @author cobrakik
 */
class Administrador extends Eloquent {

    const RESULTADOS_POR_PAGINA = 10;

    public static $table = "administradores";
    public static $timestamps = false;

    public static function find_by_name($nombreAdministrador) {
        return Administrador::where('nombre', '=', $nombreAdministrador)->first();
    }

    /**
     * Relacion uno a uno de Administrador a DescripcionUsuario
     * @return DescripcionUsuario Retorna la descripcion del Administrador
     */
    public function descripcion() {
        return DescripcionUsuario::where('id', '=', $this->descripcion_usuarios_id)->first();
        //return $this->belongs_to('DescripcionUsuario'); // indica que contiene la clave foranea de la tabla DescripcionUsuario
    }

    public function albums($resultados_por_pagina = self::RESULTADOS_POR_PAGINA, $orden = 'desc') {
        return Album::where('administradores_id', '=', $this->id)->paginate($resultados_por_pagina);
    }

    public function fotos() {
        return Foto::where('administradores_id', '=', $this->id)->paginate();
    }

    public function presentaciones() {
        return Presentacion::where('administradores_id', '=', $this->id)->paginate();
    }

    public function servicios() {
        return Servicio::where('administrador_id', '=', $this->id)->paginate();
    }

}

?>
