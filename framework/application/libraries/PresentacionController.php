<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PresentacionesController
 *
 * @author cobrakik
 */
class PresentacionController {

    public function nuevaPresentacion($nombre, $idFotos) {
        if (trim($nombre) == "") {
            throw new NotifierValidatorException("Asigne un numbre a la presentación");
        }

        if (!is_array($idFotos) || count($idFotos) <= 0) {
            throw new NotifierValidatorException("seleccione al menos una foto.");
        }

        $presenacion = new Presentacion();
        $presenacion->administradores_id = Auth::user()->id;
        $presenacion->nombre = $nombre;

        try {
            $presenacion->save();
        } catch (Exception $exc) {
            throw new Exception("Error de base de datos: ");
        }

        $this->agregarFotos($presenacion->nombre, $presenacion->administradores_id, $idFotos);
        /*
          $fotos_insertadas = 0;
          foreach ($idFotos as $idFoto) {
          $success = Laravel\Database::table('presentaciones_has_fotos')->insert(array(
          'presentacion_nombre' => $presenacion->nombre,
          'foto_id' => $idFoto,
          ));
          if (!$success) {
          throw new NotifierValidatorException("De " + count($idFotos) + " solo se insertaron " + $fotos_insertadas);
          }
          $fotos_insertadas++;
          }
         *
         */
    }

    public function getListPresentaciones() {
        return Presentacion::select()->paginate();
    }

    public function eliminarPresentacion($id_admin, $nombre) {
        $num_rows_delete = Presentacion::where('administradores_id', '=', $id_admin)->where('nombre', '=', $nombre)->delete();
        if ($num_rows_delete != 1) {
            throw new NotifierValidatorException("Ocurrio un error al momento de eliminar la presentación");
        }
    }

    public function getPresentacion($id_admin, $nombre) {
        $presentacion = Presentacion::where('administradores_id', '=', $id_admin)->where('nombre', '=', $nombre)->first();
        if (is_null($presentacion)) {
            throw new NotifierValidatorException("No se encontro la presentacion solicitada.");
        }
        return $presentacion;
    }

    public function eliminarFotoDePresentacionPorId($presentacion_nombre, $foto_id) {
        $count = \Laravel\Database::table('presentaciones_has_fotos')->where('presentacion_nombre', '=', $presentacion_nombre)->count();
        if ($count > 1) {
            $num_rows = \Laravel\Database::table('presentaciones_has_fotos')->where('presentacion_nombre', '=', $presentacion_nombre)->where('foto_id', '=', $foto_id)->delete();
            if ($num_rows == 0) {
                throw new NotifierValidatorException("Ocurrio un error, no se pudo eliminar la presentación");
            }
        } else {
            throw new NotifierValidatorException("La presentacion deve tener al menos una foto.");
        }
    }

    public function buscar($name, $admin_id = -1) {
        $presentacion = null;
        if ($admin_id == -1) {
            $presentacion = Presentacion::where('nombre', '=', $name)->first();
        } else {
            $presentacion = Presentacion::where('nombre', '=', $name)->where('administradores_id', '=', $admin_id)->first();
        }
        if (is_null($presentacion)) {
            throw new NotifierValidatorException('La presentacion solicitada no existe');
        }
        return $presentacion;
    }

    public function cambiarNombrePresentacion($admin_id, $old_name, $new_name) {
        $this->actualizarPresentacion($admin_id, $old_name, $new_name);
    }

    public function cambiarDescripcionDePresentacion($admin_id, $name, $descripcion) {
        $this->actualizarPresentacion($admin_id, $name, "", $descripcion);
    }

    public function actualizarPresentacion($admin_id, $name, $new_name = "", $descripcion = "") {
        $data = array();

        if ($new_name == "" && $descripcion == "") {
            throw new NotifierValidatorException("No se puede actualizar la presentacion con datos en blanco.");
        }
        if ($new_name != "") {
            $data['nombre'] = $new_name;
        }
        if ($descripcion != "") {
            $data['descripcion'] = $descripcion;
        }

        $rows_afected = Laravel\Database::table(Presentacion::$table)->where('administradores_id', '=', $admin_id)->where('nombre', '=', $name)->update($data);
        if ($rows_afected != 1) {
            throw new NotifierValidatorException("Ocurrio un al actualizar la presentación");
        }
    }

    public function agregarFotos($nombre, $idAdmin, $fotosId) {
        $presentacion = $this->buscar($nombre, $idAdmin);

        $fotos_insertadas = 0;
        foreach ($fotosId as $idFoto) {
            $success = true;
            try {
                $success = Laravel\Database::table('presentaciones_has_fotos')->insert(array(
                    'presentacion_nombre' => $presentacion->nombre,
                    'foto_id' => $idFoto,
                ));
            } catch (Laravel\Database\Exception $ex) {
                continue;
            }

            if (!$success) {
                throw new NotifierValidatorException("De " + count($fotosId) + " solo se insertaron " + $fotos_insertadas);
            }
            $fotos_insertadas++;
        }
    }

    public function buscarPresentaciones($name) {
        return Presentacion::where('nombre', 'like', '%' . $name . '%')->paginate();
    }

}

?>
