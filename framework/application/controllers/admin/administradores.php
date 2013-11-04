<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of administradores
 *
 * @author cobrakik
 */
class Admin_Administradores_Controller extends Admin_Base_Controller {

    public function get_index() {
        return Laravel\Redirect::to('admin/administradores/result/todos');
    }

    public function get_nuevo() {
        return View::make('admin.administradores.nuevo')->with(array('activeAdministradores' => true, 'activeNuevo' => true));
    }

    public function post_nuevo() {
        $rules = array(
            'nombre' => 'required',
            'app' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'email',
            'nikname' => 'required|min:3|unique:' . Administrador::$table . ',nombre',
            'password' => 'required|min:4|different:nombre|different:nikname|confirmed',
            'password_confirmation' => 'required'
        );
        $validation = \Laravel\Validator::make(Input::all(), $rules);
        if ($validation->fails()) {
            return \Laravel\Redirect::back()->with_input()->with_errors($validation);
        }

        $rules = array('telefono' => 'min:8|max:15');
        $validation = \Laravel\Validator::make(Input::all(), $rules);
        if ($validation->fails()) {
            return \Laravel\Redirect::back()->with_input()->with_errors($validation);
        }

        $rules = array('telefono' => 'numeric');
        $validation = \Laravel\Validator::make(Input::all(), $rules);
        if ($validation->fails()) {
            return \Laravel\Redirect::back()->with_input()->with_errors($validation);
        }

        $us_desc = new DescripcionUsuario();
        $us_desc->nombre = Input::get('nombre');
        $us_desc->apellido_paterno = Input::get('app');
        $us_desc->apellido_materno = Input::get('apm');
        $us_desc->direccion = Input::get('direccion');
        $us_desc->telefono = Input::get('telefono');
        $us_desc->email = Input::get('email');
        $us_desc->save();

        $us = new Administrador();
        $us->descripcion_usuarios_id = $us_desc->id;
        $us->nombre = Input::get('nikname');
        $us->password = Input::get('password');
        $us->activo = true;

        $us->save();
        return Laravel\Redirect::to('admin/administradores/result/todos');
    }

    public function get_editar($id) {
        $id = base64_decode($id);
        $us = Administrador::find($id);

        if (is_null($us)) {
            return Laravel\View::make('admin.message')->with(array('msg' => 'No se encontro al administrador'));
        }

        $us_desc = $us->descripcion();
        return View::make('admin.administradores.editar')->with(array('us' => $us, 'us_desc' => $us_desc, 'activeAdministradores' => true));
    }

    public function post_editar() {
        $rules = array(
            'nombre' => 'required',
            'app' => 'required',
            'direccion' => 'required',
            'telefono' => 'required|numeric',
            'email' => 'email',
            'password_old' => 'required|exists:' . Administrador::$table . ',password',
            'password' => 'required|min:4|different:nombre|different:nikname|confirmed',
            'password_confirmation' => 'required'
        );
        $validation = \Laravel\Validator::make(Input::all(), $rules);
        if ($validation->fails()) {
            return \Laravel\Redirect::back()->with_input()->with_errors($validation);
        }

        $id = base64_decode(Input::get('id'));
        $us = Administrador::find($id);
        $us_desc = $us->descripcion();

        $us_desc->nombre = Input::get('nombre');
        $us_desc->apellido_paterno = Input::get('app');
        $us_desc->apellido_materno = Input::get('apm');
        $us_desc->direccion = Input::get('direccion');
        $us_desc->telefono = Input::get('telefono');
        $us_desc->email = Input::get('email');

        $us_desc->save();

        $us->nombre = Input::get('nikname');
        $us->password = Input::get('password');
        $us->activo = true;

        $us->save();
        return Laravel\Redirect::to('admin/administradores/result/todos');
    }

    public function get_eliminar($id) {
        $id = base64_decode($id);
        $us = Administrador::find($id);
        if ($us->id == Auth::user()->id) {
            return Message::showMessage('No te puedes eliminar a ti mismo', 'Advertencia');
        }
        if (Administrador::select()->count() <= 1) {
            return Message::showMessage('Actualmente solo existe un Administrador, por lo que no se puede eliminar', 'Advertencia');
        }

        $us_desc = $us->descripcion();
        try {
            $us->delete();
            $us_desc->delete();
        } catch (Exception $ex) {
            return Message::showMessage('No se puede remover del sistema al Administrador seleccionado, primero elimina todos los servicios, albumes, etc. que alla publicado dicho Administrador', 'Advertencia');
            //$this->get_desactivar(base64_encode($id));
        }
        return \Laravel\Redirect::back();
    }

    public function get_ver($id) {
        $us = Administrador::find(base64_decode($id));
        $us_dec = $us->descripcion();
        return View::make('admin.administradores.ver')->with(array('us_desc' => $us_dec, 'activeAdministradores' => true));
    }

    public function get_activar($id) {
        $user = Administrador::find(base64_decode($id));
        $user->activo = true;
        $user->save();
        return Laravel\Redirect::back();
    }

    public function get_desactivar($id) {
        $user = Administrador::find(base64_decode($id));
        if (Administrador::select()->count() <= 1) {
            return Message::showMessage('Actualmente solo hay un Administrador Activo, por lo que no lo puedes desactivar', 'Advertencia');
        }
        $user->activo = false;
        $user->save();
        return Laravel\Redirect::back();
    }

    public function get_result($arg) {
        $users = null;
        $registros_por_pagina = 15;
        $accion = "sin accion";
        $activeLink = "";
        switch ($arg) {
            case 'todos':
                $activeLink = "activeTodos";
                $accion = "Todos Los Registros";
                $users = Administrador::select()->order_by('nombre', 'desc')->paginate($registros_por_pagina);
                break;
            case 'activos':
                $activeLink = "activeActivos";
                $accion = "Administradores Activos";
                $users = Administrador::where('activo', '=', true)->order_by('nombre', 'desc')->paginate($registros_por_pagina);
                break;
            case 'inactivos':
                $activeLink = "activeInactivos";
                $accion = 'Administradores Inactivos';
                $users = Administrador::where('activo', '=', false)->order_by('nombre', 'desc')->paginate($registros_por_pagina);
                break;
        }
        return View::make('admin.administradores.result')->with(array('users' => $users, 'accion' => $accion, 'activeAdministradores' => true, $activeLink => true));
    }

    public function get_buscar() {
        $txtBuscar = Input::get('txtBuscar');
        $listFiltro = Input::get('listFiltro');
        $listOrden = Input::get('listOrden');
        $listResultadosPorPagina = Input::get('listResultadosPorPagina');

        $users = null;
        $us_desc = null;

        switch ($listFiltro) {
            case 'id_admin':
                $users = Administrador::where('id', '=', $txtBuscar)->order_by('id', $listOrden)->paginate($listResultadosPorPagina);
                break;
            case 'nom_administrador':
                $users = Administrador::where('nombre', 'like', '%' . $txtBuscar . '%')->order_by('nombre', $listOrden)->paginate($listResultadosPorPagina);
                break;
            case 'descripcion_nom':
                $us_desc = DescripcionUsuario::where('nombre', 'like', '%' . $txtBuscar . '%')->order_by('nombre', $listOrden)->paginate($listResultadosPorPagina);
                break;
            case 'descripcion_app':
                $us_desc = DescripcionUsuario::where('apellido_paterno', 'like', '%' . $txtBuscar . '%')->order_by('apellido_paterno', $listOrden)->paginate($listResultadosPorPagina);
                break;
            case 'descripcion_apm':
                $us_desc = DescripcionUsuario::where('apellido_materno', 'like', '%' . $txtBuscar . '%')->order_by('apellido_materno', $listOrden)->paginate($listResultadosPorPagina);
                break;
            case 'email':
                $us_desc = DescripcionUsuario::where('email', 'like', '%' . $txtBuscar . '%')->order_by('email', $listOrden)->paginate($listResultadosPorPagina);
                break;
            case 'fecha_reg':
                $us_desc = DescripcionUsuario::where('created_at', 'like', '%' . $txtBuscar . '%')->order_by('created_at', $listOrden)->paginate($listResultadosPorPagina);
                break;
            case 'telefono':
                $us_desc = DescripcionUsuario::where('telefono', 'like', '%' . $txtBuscar . '%')->order_by('telefono', $listOrden)->paginate($listResultadosPorPagina);
                break;
        }
        return View::make('admin.administradores.buscar')->with(array('users' => $users, 'us_desc' => $us_desc, 'txtBuscar' => $txtBuscar, 'listFiltro' => $listFiltro, 'listOrden' => $listOrden, 'listResultadosPorPagina' => $listResultadosPorPagina, 'activeAdministradores' => true, 'activeBuscar' => true));
    }

}

?>
