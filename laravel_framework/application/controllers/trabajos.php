<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Trabajos_Controller extends Base_Controller {

    public function get_index() {
        $control = new AlbumController();
        $albumes = $control->todosLosAlbums(3);
        return Laravel\View::make('client.trabajos')->with(array('albumes' => $albumes));
    }

    public function get_ver_album($id_encode) {
        $id = base64_decode($id_encode);
        $control = new AlbumController();
        $album = $control->buscarAlbumPorId($id);
        return Laravel\View::make('client.ver_album')->with(array('fotos' => $album->fotos(), 'id' => $album->id));
    }

    public function post_cargar_album() {
        $id = base64_decode(Input::get('id'));
        $control = new AlbumController();
        $album = $control->buscarAlbumPorId($id);
        return Laravel\View::make('client.ajax.img_canvas')->with(array('fotos' => $album->fotos()));
    }
    
    public function get_cargar_album() {
        $id = base64_decode(Input::get('id'));
        $control = new AlbumController();
        $album = $control->buscarAlbumPorId($id);
        return Laravel\View::make('client.ajax.img_canvas')->with(array('fotos' => $album->fotos()));
    }

}

?>
