<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FotoController
 *
 * @author cobrakik
 */
class FotoController {

    /**
     * Cambia la url de todas las fotos del album segun su id
     * @param int $idAlbum
     * @param string $url
     */
    public function cambiarUrl($idAlbum, $url) {
        $album = Album::find($idAlbum);
        $fotos = $album->fotos();
        foreach ($fotos->results as $foto) {
            $foto->url = $this->cambiarUrlFoto($foto, $url);
            $foto->save();
        }
    }

    public function cambiarUrlFoto(Foto $foto, $url) {
        if (!ends_with($url, '/')) {
            $url .= '/';
        }
        $new_url = $url . $this->getFileName($foto);
        return $new_url;
    }

    /**
     * Obtiene el nombre real de la foto almacenada en el disco
     * @param Foto $foto
     * @return string
     */
    public function getFileName(Foto $foto) {
        return Format::textToDirFormat($foto->nombre);
    }

    public function buscarFotoPorId($id) {
        $foto = Foto::find($id);
        if (is_null($foto)) {
            throw new NotifierValidatorException('La foto no se pudo encontrar');
        }
        return $foto;
    }

    public function buscarFotoPorNombre($nombre) {
        $foto = Foto::find_by_name($nombre);
        if (is_null($foto)) {
            throw new NotifierValidatorException('La foto no se pudo encontrar');
        }
        echo $foto->nombre;
        exit;
        return $foto;
    }

    public function editarFotoPorId($id, Foto $foto) {
        $aux_foto = $this->buscarFotoPorId($id);
        if ($aux_foto->getSimpleName() != $foto->getSimpleName()) {
            $foto->url = $this->cambiarNombreDeArchivo($foto->nombre, $foto);
        }
        $foto->save();
    }

    public function cambiarNombreDeArchivo($nuevo_nombre, Foto $foto) {
        $ext = $foto->getExtension();
        $foto->nombre = Format::trimEpecialChars($nuevo_nombre) . '.' . $ext;
        $nombre_archivo = $this->getFileName($foto);
        $old_path = AlbumController::REAL_ROOT . $foto->getPath();
        $new_path = $foto->album()->url;

        if (!ends_with($new_path, '/')) {
            $new_path .= '/';
        }
        $new_path .= $nombre_archivo;
        $new_real_path = AlbumController::REAL_ROOT . $new_path;
        
        if (!Laravel\File::exists($old_path)) {
            throw new NotifierValidatorException('La foto que se quiere renombrar no existe fisicamente en el disco del servidor!!!');
        }

        if (File::exists($new_real_path)) {
            throw new NotifierValidatorException('El nombre: ' . $foto->nombre . ', ya esta siendo utilizado por otra foto del mismo album.');
        }
        Laravel\File::copy($old_path, $new_real_path);
        if (!File::exists($new_real_path)) {
            throw new NotifierValidatorException('Ocurrio un error al renombrar la foto.');
        }
        if (!Laravel\File::delete($old_path)) {
            throw new NotifierValidatorException('Se duplico la foto con el nuevo nombre, pero no se pudo eliminar la foto original que se intento renombrar');
        }
        return $new_path;
    }

    public function eliminarFotoPorId($id) {
        $foto = Foto::find($id);
        if (!Laravel\File::delete(AlbumController::REAL_ROOT . $foto->url)) {
            throw new NotifierValidatorException('Ocurrio un error al eliminar la foto fisicamente, por lo que podria no verse la imagen en el sistema');
        }
        $foto->delete();
    }

}

?>
