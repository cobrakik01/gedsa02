<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PresentacionPrincipal
 *
 * @author cobrakik
 */
class PresentacionPrincipal extends Laravel\Database\Eloquent\Model {

    public static $table = "presentacion_principal";
    public static $key = 'presentaciones_nombre';
    public static $timestamps = false;

    public function presentacion() {
        return Presentacion::where('nombre', '=', $this->presentaciones_nombre)->first();
    }

    public static function principal() {
        if (static::existe()) {
            return PresentacionPrincipal::select()->first();
        } else {
            throw new NotifierValidatorException("No se ha seleccionado ninguna presentacion -- Clase PresentacionPrincipal");
        }
    }

    public static function establecer(Presentacion $presentacion) {
        if (!static::existe()) {
            $presentacion_principal = new PresentacionPrincipal();
            $presentacion_principal->presentaciones_nombre = $presentacion->nombre;
            $presentacion_principal->save();
        } else {
            throw new NotifierValidatorException("No puede haver mas de una presentacion principal - Clase PresentacionPrincipal");
        }
    }

    public static function remover() {
        $b = false;
        if (static::existe()) {
            PresentacionPrincipal::select()->delete();
        }
        if (!static::existe()) {
            $b = true;
        }
        return $b;
    }

    public static function existe() {
        $count = PresentacionPrincipal::select()->count();
        $b = false;
        if ($count == 1) {
            $b = true;
        } else if ($count > 1) {
            throw new NotifierValidatorException("Existen más de una presentación -- Clase PresentacionPrincipal");
        }
        return $b;
    }

}

?>
