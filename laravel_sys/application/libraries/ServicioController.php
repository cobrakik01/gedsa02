<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ServicioController
 *
 * @author cobrakik
 */
class ServicioController {

    private $error;

    public function getError() {
        return $this->error;
    }

    public function existe($nombre) {
        return !is_null(Servicio::find($nombre));
    }

    public function nuevo($nombre, $descripcion) {
        $b = true;
        if ($this->existe($nombre)) {
            $this->error = NotifierValidator::createError('El servicio "' . $nombre . '" ya existe.');
            return false;
        }

        $id_admin = Auth::user()->id;
        $servicio = new Servicio();
        $servicio->nombre = trim($nombre);
        $servicio->descripcion = trim($descripcion);
        $servicio->administrador_id = $id_admin;
        $servicio->save();
        return $b;
    }

    public function todos($paginate = 10) {
        return Servicio::select()->paginate($paginate);
    }

    public function eliminar($nombre) {
        $b = true;
        $nombre = trim($nombre);
        if (!$this->existe($nombre)) {
            $this->error = NotifierValidator::createError('El servicio que se desea eliminar no existe.');
            return false;
        }

        $servicio = Servicio::find($nombre);
        $servicio->delete();
        return $b;
    }

    public function buscarServicioPorNombre($nombre) {
        return Servicio::find($nombre);
    }

    public function editar($old_name, $new_name, $description) {
        $b = true;

        $old_name = trim($old_name);
        $new_name = trim($new_name);
        $description = trim($description);

        /*
          if ($this->existe($new_name)) {
          $this->error = NotifierValidator::createError('El nombre del servicio ya esta en uso.');
          return false;
          }
         */

        $servicio = Servicio::find($old_name);
        $servicio->nombre = $new_name;
        $servicio->descripcion = $description;
        $servicio->save();

        $rows_afected = \Laravel\Database::table(Servicio::$table)->where('nombre', '=', $old_name)->update(array('nombre' => $new_name, 'descripcion' => $description));

        if ($rows_afected <= 0) {
            $this->error = NotifierValidator::createError('No se pudo realizar ninguna accion');
            return false;
        }
        if ($rows_afected > 1) {
            $this->error = NotifierValidator::createError('Ocurrio un erro grabe y se modificaron mas de un registro.');
            return false;
        }
        return $b;
    }

    public function buscarPorNombreUsuario($nombreUsuario) {
        $admin = Administrador::where('nombre', '=', $nombreUsuario)->first();
        if (is_null($admin)) {
            return Administrador::where('nombre', '=', $nombreUsuario)->paginate();
        }
        return $admin->servicios();
    }

    public function buscarServiciosPorNombre($txt) {
        return Servicio::where('nombre', '=', $txt)->paginate();
    }

    public function buscarServiciosPorFechaPublicacion($txt) {
        return Servicio::where('created_at', 'like', '%' . $txt . '%')->order_by('created_at', 'desc')->paginate();
    }

    public function editarNombre($old_name, $new_name) {
        $b = true;
        $nrows_affected = Servicio::where('nombre', '=', trim($old_name))->update(array('nombre' => trim($new_name)));
        if ($nrows_affected == 0) {
            $this->error = NotifierValidator::createError('No se pudo actualizar el nombre del servicio');
            return false;
        } else if ($nrows_affected > 1) {
            $this->error = NotifierValidator::createError('Error grabe, se actualizaron dos o varios registros con el mismo nombre');
            return false;
        }
        return $b;
    }

    public function editarDescripcion($service_name, $description) {
        $b = true;
        $nrows_affected = Servicio::where('nombre', '=', trim($service_name))->update(array('descripcion' => trim($description)));
        if ($nrows_affected == 0) {
            $this->error = NotifierValidator::createError('No se pudo actualizar la descripcion del servicio.');
            return false;
        } else if ($nrows_affected > 1) {
            $this->error = NotifierValidator::createError('Error grabe, se actualizaron dos o varios registros con la misma descripción.');
            return false;
        }
        return $b;
    }

}

?>
