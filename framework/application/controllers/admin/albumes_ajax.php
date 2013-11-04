<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Albums_Admin_Ajax
 *
 * @author cobrakik
 */
class Admin_Albumes_Ajax_Controller extends Admin_Base_Controller {

    public function get_index() {
        return "No tienes los permisos para ver esta pagina";
    }

    public function get_results($action = "mis_albums") {
        $cont = new AlbumController();
        $titulo = "";
        $albums = null;
        switch ($action) {
            case "mis_albums":
                $titulo = "Mis Álbumes";
                $albums = $cont->buscarAlbumsPorIdDeAdministrador(Auth::user()->id);
                break;
            case "todos":
                $titulo = "Todos los Álbumes";
                $albums = $cont->todosLosAlbums();
                break;
        }
        return \Laravel\View::make('admin.presentaciones.ajax.results')->with(array('albums' => $albums, 'titulo' => $titulo));
    }

    public function post_nueva_presentacion() {
        $jsonPresentacion = Input::get("data");
        $control = new PresentacionController();

        try {
            $control->nuevaPresentacion($jsonPresentacion);
        } catch (NotifierValidatorException $ex) {
            echo $ex->getMessage();
        }
        echo "Se creo correctamente la presentación.";
    }

    public function get_open() {
        $id = trim(Input::get('id'));
        $controlador = new AlbumController();
        try {
            $album = $controlador->buscarAlbumPorId($id, false);
            $fotos = $album->fotos();
            return \Laravel\View::make('admin.presentaciones.ajax.fotos')->with(array('fotos' => $fotos, 'album' => $album));
        } catch (NotifierValidatorException $ex) {
            return $ex->getMessage();
        }
    }

    public function get_load() {
        $controlador = new AlbumController();
        $albumes = $controlador->todosLosAlbums();
        return \Laravel\View::make('admin.albums.ajax.load')->with(array('albumes' => $albumes));
    }

}

?>
