<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Admin_Albumes_Controller extends Admin_Base_Controller {

    public function get_index() {
        return Laravel\Redirect::to('admin/albumes/mis_albums');
    }

    public function get_nuevo() {
        return Laravel\View::make('admin.albums.nuevo')->with(array('activeAlbumes' => true, 'activeNuevo' => true));
    }

    public function post_nuevo() {
        $controlador = new AlbumController();
        $album = new Album();
        $album->nombre = Input::get('nombre');
        $album->descripcion = Input::get('descripcion');
        $errors = $controlador->nuevoAlbum($album);
        if ($errors->fails()) {
            return \Laravel\Redirect::back()->with_input()->with_errors($errors);
        }
        return Laravel\Redirect::to('admin/albumes/ver_fotos/' . AlbumController::toDir($album));
    }

    public function get_mis_albums() {
        $controlador = new AlbumController();
        $albums = $controlador->buscarAlbumsPorIdDeAdministrador(Auth::user()->id);
        return Laravel\View::make('admin.albums.mis_albums', array('albums' => $albums, 'activeAlbumes' => true, 'activeMisAlbumes' => true));
    }

    public function get_todos() {
        $controlador = new AlbumController();
        $albums = $controlador->todosLosAlbums();
        return Laravel\View::make('admin.albums.todos', array('albums' => $albums, 'activeAlbumes' => true, 'activeTodos' => true));
    }

    public function get_cambiar_nombre_descripcion($dir_album = "") {
        $controlador = new AlbumController();
        $album = $controlador->buscarPorNombreDeAlbum($dir_album);
        if (is_null($album)) {
            Message::showMessage('El album: ' . Format::dirToTextFormat($dir_album) . ', no existe');
        }
        return Laravel\View::make('admin.albums.cambiar_nombre_descripcion')->with(array('album' => $album, 'activeAlbumes' => true));
    }

    public function post_cambiar_nombre_descripcion() {
        $cont = new AlbumController();
        $album = new Album();
        $album->nombre = Input::get('nombre');
        $album->descripcion = Input::get('descripcion');

        $errors = $cont->actualizarPorId(Input::get('id'), $album);
        if ($errors->fails()) {
            return \Laravel\Redirect::back()->with_input()->with_errors($errors);
        }

        return Laravel\Redirect::to('admin/albumes/ver_fotos/' . AlbumController::toDir($album));
    }

    public function get_buscar_album() {
        $controlador = new AlbumController();
        $orden = Input::get('orden');
        $buscar = trim(Input::get('buscar'));
        $resultados = Input::get('resultados');
        $op = Input::get('filtro');
        $albums = null;

        try {
            switch ($op) {
                case 0;
                    $albums = $controlador->buscarAlbumPorId($buscar, true, $resultados, $orden);
                    break;
                case 1:
                    $albums = $controlador->buscarPorNombreDeAlbum($buscar, true, $resultados, $orden);
                    break;
                case 2:
                    $albums = $controlador->buscarPorFecha($buscar, true, $resultados, $orden);
                    break;
                case 3:
                    $albums = $controlador->buscarAlbumsPorNombreDeAdministrador($buscar, $resultados, $orden);
                    break;
            }
            return \Laravel\View::make('admin.albums.buscar_album')->with(array('albums' => $albums, 'activeAlbumes' => true, 'activeBuscarAlbumes' => true));
        } catch (NotifierValidatorException $ex) {
            $not = $ex->getNotification();
            if ($not->fails()) {
                return \Laravel\Redirect::back()->with_errors($not);
            }
        }
    }

    public function get_ver_fotos($nombre_album = "") {
        $controlador = new AlbumController();
        $album = $controlador->buscarPorNombreDeAlbum($nombre_album);
        if (is_null($album)) {
            return Message::showMessage('Esta pagina no esta disponible');
        }
        $fotos = $album->fotos(8);
        return Laravel\View::make('admin.albums.ver')->with(array('album' => $album, 'fotos' => $fotos, 'activeAlbumes' => true));
    }

    public function post_subir_foto() {
        $usar_nombre_archivo = Input::get('nombre_archivo');
        $cont_album = new AlbumController();

        $rules = array();
        if (!$usar_nombre_archivo)
            $rules['nombre'] = 'required';

        try {
            $cont_album->subirFoto(Input::get('nombre_album'), Input::get('descripcion'), 'foto', Input::get('nombre'), $rules);
            return Laravel\Redirect::to('admin/albumes/ver_fotos/' . Format::textToDirFormat(Input::get('nombre_album')));
        } catch (NotifierValidatorException $ex) {
            $errors = $ex->getNotification();
            if ($errors->fails()) {
                return \Laravel\Redirect::back()->with_errors($errors);
            }
        }
    }

    public function get_eliminar($nombre_album = "") {
        $controlador = new AlbumController();
        try {
            $controlador->eliminarAlbumPorNombre($nombre_album);
        } catch (Exception $ex) {
            return Message::showMessage($ex->getMessage());
        }
        return \Laravel\Redirect::back();
    }

    public function get_editar_foto($id = "") {
        $controlador = new FotoController();
        try {
            if ($id == "") {
                return Message::showMessage('No se selecciono ninguna foto para editar', 'Pagina no disponible');
            }
            $foto = $controlador->buscarFotoPorId($id);
            return \Laravel\View::make('admin.albums.editar_foto')->with(array('foto' => $foto, 'activeAlbumes' => true));
        } catch (NotifierValidatorException $ex) {
            return Message::showMessage($ex->getMessage());
        }
    }

    public function post_editar_foto() {
        $controlador = new FotoController();
        $foto = $controlador->buscarFotoPorId(Input::get('id'));
        try {
            $foto->nombre = trim(Input::get('nombre'));
            $foto->descripcion = trim(Input::get('descripcion'));
            $controlador->editarFotoPorId($foto->id, $foto);
        } catch (NotifierValidatorException $ex) {
            $val = $ex->getNotification();
            if ($val->fails()) {
                return \Laravel\Redirect::back()->with_input()->with_errors($val);
            }
            return Message::showMessage($ex->getMessage(), 'Advertencia');
        }
        return Laravel\Redirect::to('admin/albumes/ver_fotos/' . $foto->album()->get_dir());
    }

    public function get_eliminar_foto($id) {
        if (trim($id) == "") {
            return Message::showMessage('Pagina no disponible');
        }
        $controlador = new FotoController();
        $album_dir = "";
        try {
            $foto = $controlador->buscarFotoPorId($id);
            $album_dir = $foto->album()->get_dir();
            $controlador->eliminarFotoPorId($id);
        } catch (NotifierValidatorException $ex) {
            $val = $ex->getNotification();
            if ($val->fails()) {
                return \Laravel\Redirect::back()->with_input()->with_errors($val);
            }
            return Message::showMessage($ex->getMessage(), 'Advertencia');
        }
        return Laravel\Redirect::to('admin/albumes/ver_fotos/' . $album_dir);
    }

}

?>
