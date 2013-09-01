<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of servicios
 *
 * @author cobrakik
 */
class Admin_Servicios_Controller extends Admin_Base_Controller {

    public function get_index() {
        return Laravel\Redirect::to('admin/servicios/todos');
    }

    public function get_nuevo() {
        return Laravel\View::make('admin.servicios.nuevo')->with(array('activeServicios' => true, 'activeNuevo' => true));
    }

    public function post_nuevo() {
        $nombre = Input::get('nombre');
        $descripcion = Input::get('descripcion');

        $control = new ServicioController();
        if ($control->nuevo($nombre, $descripcion)) {
            return \Laravel\Redirect::to('admin/servicios/todos');
        } else {
            return \Laravel\Redirect::back()->with_input()->with_errors($control->getError());
        }
    }

    public function get_editar($nombre_encode) {
        if ($nombre_encode == "") {
            return Message::showMessage('No se elimino ningun servicio.', 'Pagina no disponible');
        }

        $control = new ServicioController();
        $servicio = $control->buscarServicioPorNombre(base64_decode(trim($nombre_encode)));

        return \Laravel\View::make('admin.servicios.editar')->with(array('activeServicios' => true, 'servicio' => $servicio));
    }

    public function post_editar() {
        $old_name = trim(base64_decode(Input::get('old_nombre')));
        $new_name = trim(Input::get('nombre'));
        $description = trim(Input::get('descripcion'));

        $control = new ServicioController();
        if ($control->editar($old_name, $new_name, $description)) {
            return \Laravel\Redirect::to('admin/servicios/todos');
        } else {
            return \Laravel\Redirect::back()->with_input()->with_errors($control->getError());
        }
    }

    public function get_todos() {
        $control = new ServicioController();
        $servicios = $control->todos(5);
        return Laravel\View::make('admin.servicios.todos')->with(array('activeServicios' => true, 'activeTodos' => true, 'servicios' => $servicios));
    }

    public function get_eliminar($nombre_encode = "") {
        if ($nombre_encode == "") {
            return Message::showMessage('No se elimino ningun servicio.', 'Pagina no disponible');
        }

        $control = new ServicioController();
        if ($control->eliminar(base64_decode(trim($nombre_encode)))) {
            return \Laravel\Redirect::back();
        } else {
            return \Laravel\Redirect::back()->with_errors($control->getError());
        }
    }

    public function get_buscar() {
        $txt = trim(Input::get('txt'));
        $filtro = trim(Input::get('filtro'));
        $control = new ServicioController();
        $servicios = null;
        switch ($filtro) {
            case 0:
            case 1:
                $servicios = $control->todos();
                break;
            case 2:
                $servicios = $control->buscarPorNombreUsuario($txt);
                break;
            case 3:
                $servicios = $control->buscarServiciosPorNombre($txt);
                break;
            case 4:
                $servicios = $control->buscarServiciosPorFechaPublicacion($txt);
                break;
        }
        //Terminar el modulo de busqueda y colocar la opcion de contenido predefinido para los correos electronicos
        return Laravel\View::make('admin.servicios.buscar')->with(array('activeServicios' => true, 'activeBuscar' => true, 'txt' => $txt, 'filtro' => $filtro, 'servicios' => $servicios));
    }

    public function get_ver($nombre_servicio_encode = "") {
        if ($nombre_servicio_encode == "") {
            return Message::showMessage('Seleccione algun servicio.', 'Pagina no disponible');
        }

        $control = new ServicioController();
        $servicio = $control->buscarServicioPorNombre(trim(base64_decode($nombre_servicio_encode)));

        if (is_null($servicio)) {
            return \Laravel\Redirect::back()->with_errors(NotifierValidator::createError('El servicio seleccionado no se encontro'));
        }

        return View::make('admin.servicios.ver')->with(array('activeServicios' => true, 'servicio' => $servicio));
    }

    /**
     * *******************************************************************************
     *                              AJAX
     * *******************************************************************************
     */
    public function post_editar_nombre() {
        $old_name = Input::get('old_name');
        $new_name = Input::get('new_name');

        $control = new ServicioController();
        if (!$control->editarNombre($old_name, $new_name)) {
            return "Error al actualizar el nombre del servicio";
        }
        $servicio = Servicio::find($new_name);
        echo $servicio->nombre;
    }

    public function post_editar_descripcion() {
        $service_name = Input::get('service_name');
        $description = Input::get('description');

        $control = new ServicioController();
        if (!$control->editarDescripcion($service_name, $description)) {
            return "Error al actualizar la descripción del servicio.";
        }
        $servicio = Servicio::find($service_name);
        echo $servicio->descripcion;
    }

}

?>
