<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AlbumController
 *
 * @author cobrakik
 */
class AlbumController {

    const REAL_ROOT = "../";
    const ALBUMS_PATH = "uploads/albums/";
    const RESULTADOS_POR_PAGINA = 10;
    const ASC = "asc";
    const DESC = "desc";

    /**
     * 
     * @param Album $album Se requiere que por lo menos el atributo Album->nombre exista
     * @return string Retorna el nombre sustituyendo los guiones bajos por espacios omitiendo las tildes, ejemplo: Mi_Album, por: Mi Album
     */
    public static function toDir(Album $album) {
        return Format::textToDirFormat($album->nombre);
    }

    /**
     * 
     * @param Album $album Se requiere que por lo menos el atributo Album->nombre exista
     * @return string Retorna el nombre sustituyendo los espacios por guiones bajos omitiendo las tildes, ejemplo: Mi Álbum, por: Mi_Album
     */
    public static function toName(Album $album) {
        return Format::dirToTextFormat($album->nombre);
    }

    public function buscarAlbumPorId($id, $paginate = false, $resultados_por_pagina = self::RESULTADOS_POR_PAGINA, $orden = AlbumController::DESC) {
        $albums = null;
        if ($paginate) {
            $albums = Album::where('id', 'like', '%' . $id . '%')->order_by('id', $orden)->paginate($resultados_por_pagina);
            if ($albums->total == 0) {
                throw new NotifierValidatorException('<h3>Sin resultados</h3> No se encontro ningun álbum con el id: ' . $id);
            }
        } else {
            $albums = Album::find($id);
            if (is_null($albums)) {
                throw new NotifierValidatorException('<h3>Sin resultados</h3> No se encontro ningun álbum con el id: ' . $id);
            }
        }
        return $albums;
    }

    public function buscarAlbumsPorNombreDeAdministrador($nombreAdministrador, $resultados_por_pagina = AlbumController::RESULTADOS_POR_PAGINA, $orden = AlbumController::DESC) {
        $admin = Administrador::find_by_name($nombreAdministrador);
        if (is_null($admin)) {
            throw new NotifierValidatorException('<h3>Sin resultados</h3> El autor: ' . $nombreAdministrador . ', no existe');
        }
        $albums = Album::where('administradores_id', '=', $admin->id)->order_by('administradores_id', $orden)->paginate($resultados_por_pagina);
        if ($albums->total == 0) {
            throw new NotifierValidatorException('<h3>Sin resultados</h3> El autor: ' . $nombreAdministrador . ', no tiene álbumes publicados');
        }
        return $albums;
    }

    /**
     * 
     * @param Integer $id Id del Album que se buscara
     * @param Integer $resultados_por_pagina indica el numero de resultados por pagina que se presentaran en la vista
     * @return Paginator se puede acceder a los objetos de tipo Album por medio del atributo Paginator->results
     * y obtener los links de la paginacion por medio del metodo Paginator->links()
     */
    public function buscarAlbumsPorIdDeAdministrador($id, $resultados_por_pagina = AlbumController::RESULTADOS_POR_PAGINA) {
        return Album::where('administradores_id', '=', $id)->order_by('administradores_id')->paginate($resultados_por_pagina);
    }

    /**
     * 
     * @param string $nombre_album Contiene el nombre del album
     * @return Album Retorna un objeto de tipo Album en caso de encontrarlo, en caso contrario retorna null
     */
    public function buscarPorNombreDeAlbum($nombre_album, $paginate = false, $limite_por_pagina = self::RESULTADOS_POR_PAGINA, $orden = AlbumController::DESC) {
        $nombre_album = Format::dirToTextFormat($nombre_album);
        $album = null;
        if ($paginate) {
            $album = Album::where('nombre', 'like', '%' . $nombre_album . '%')->order_by('nombre', $orden)->paginate($limite_por_pagina);
            if ($album->total == 0) {
                throw new NotifierValidatorException('<h3>Sin resultados</h3> No se encontro ningun álbum con el nombre: ' . $nombre_album);
            }
        } else {
            $album = Album::where('nombre', '=', $nombre_album)->first();
            if (is_null($album)) {
                throw new NotifierValidatorException('<h3>Sin resultados</h3> No se encontro ningun álbum con el nombre: ' . $nombre_album);
            }
        }
        return $album;
    }

    /**
     * 
     * @param type $fecha
     * @param type $resultados_por_pagina
     * @return type
     */
    public function buscarPorFecha($fecha, $paginate = false, $resultados_por_pagina = self::RESULTADOS_POR_PAGINA, $orden = AlbumController::DESC) {
        $album = null;
        /*
          if (!Format::date($fecha)) {
          throw new NotifierValidatorException('<h3>Sin resultados</h3> El formato de la fecha es incorrecta, el formato correcto es: aaaa-mm-dd: ' . $fecha);
          }
         * 
         */
        if ($paginate) {
            $album = Album::where('created_at', 'like', '%' . $fecha . '%')->order_by('created_at', $orden)->paginate($resultados_por_pagina);
            if ($album->total == 0) {
                throw new NotifierValidatorException('<h3>Sin resultados</h3> No se encontro ningun álbum con el nombre: ' . $fecha);
            }
        } else {
            $album = Album::where('created_at', '=', $fecha)->first();
            if (is_null($album)) {
                throw new NotifierValidatorException('<h3>Sin resultados</h3> No se encontro ningun álbum con el nombre: ' . $fecha);
            }
        }
        return $album;
    }

    /**
     * 
     * @param Integer $id Id del Album que se buscara
     * @return Paginator se puede acceder a los objetos de tipo Album por medio del atributo Paginator->results
     * y obtener los links de la paginacion por medio del metodo Paginator->links()
     */
    public function todosLosAlbums($limite_por_pagina = self::RESULTADOS_POR_PAGINA) {
        return Album::select()->paginate($limite_por_pagina);
    }

    /**
     * 
     * @param Album $album Es un objeto de tipo Album, los parapetros recividos desde la vista tendran que coincidir con los atributos del modelo
     * @return void
     */
    public function nuevoAlbum(Album $album) {
        $rules = array('nombre' => 'required|unique:' . Album::$table);
        $validation = Laravel\Validator::make(Input::all(), $rules);

        if ($validation->fails()) {
            return $validation;
        }

        $album->nombre = Format::skipTilde($album->nombre);
        $album_path = $this->getAlbumPath($album);
        $real_path_album = self::REAL_ROOT . $album_path;

        if (\Laravel\File::exists($real_path_album)) {
            return NotifierValidator::createError('La carpeta: ' . $album->nombre . ', ya existe, probablemente no este registrado en la base de datos');
        }


        $f = new \Laravel\File();
        $f->mkdir($real_path_album);

        if (!$f->exists($real_path_album)) {
            return NotifierValidator::createError('Ocurrio un error al crear el album: ' . $album->nombre);
        }

        $album->administradores_id = Auth::user()->id;
        $album->url = $album_path;
        $album->save();
        return NotifierValidator::createValid();
    }

    /**
     * Retorna el nombre del album con formato de directorio/carpeta
     * @param Album $album, nesesita tener la propiedad nombre
     * @return string
     */
    public function getDirName(Album $album) {
        return Format::textToDirFormat($album->nombre);
    }

    /**
     * Retorna la direccion de la carpeta del album.
     * @param Album $album
     * @return string
     */
    public function getAlbumPath(Album $album) {
        return self::ALBUMS_PATH . $this->getDirName($album);
    }

    /**
     * 
     * @param nombre del album que se eliminara, el nombre puede estar en formato de direccion con guines bajos o son ellos
     * @return void
     */
    public function eliminarAlbumPorNombre($nombre) {
        $file = new \Laravel\File();
        $nombre = Format::dirToTextFormat($nombre);
        $album = $this->buscarPorNombreDeAlbum($nombre);

        if (is_null($album)) {
            throw new Exception('El album que se quiere eliminar no existe');
        }

        if ($album->num_photos() > 0) {
            $nRowsOld = $album->num_photos();
            $nRows = $album->delete_all_photos();
            if ($nRowsOld != $nRows) {
                throw new Exception('Ocurrio un error al eliminar las fotos del album: ' . $album->nombre);
            }
        }

        $url = self::REAL_ROOT . $album->url;
        $album->delete();
        if ($file->exists($url)) {
            $file->rmdir($url);
        }
        if ($file->exists($url)) {
            throw new Exception('El album que se quiere eliminar no existe');
        }
        // colocar la opcion de eliminar album y/o foto aun que las fotos o el album fisico no exista, pero exista en la base de datos
    }

    public function subirFoto($nombre_album, $descripcion, $key_foto, $nombre_foto = "", $rules = array()) {
        $file = \Laravel\Input::file($key_foto);
        $rules[$key_foto] = 'required|min:5|max:2048|image|mimes:jpeg,bmp,png';
        $validation = \Laravel\Validator::make(\Laravel\Input::all(), $rules);

        if ($validation->fails()) {
            throw new NotifierValidatorException("Selecciona una foto");
        }

        $url_album = self::ALBUMS_PATH . Format::textToDirFormat($nombre_album);
        $real_path_album = self::REAL_ROOT . $url_album;

        $nombre_foto = Format::skipTilde(($nombre_foto == "") ? $file['name'] : ($nombre_foto . '.' . File::extension($file['name'])));
        $url_foto = $url_album . "/" . Format::textToDirFormat($nombre_foto);

        $real_path_photo = self::REAL_ROOT . $url_foto;

        if (Laravel\File::exists($real_path_photo)) {
            throw new NotifierValidatorException('La foto: ' . $nombre_foto . ', ya existe');
        }

        \Laravel\Input::upload('foto', $real_path_album, Format::textToDirFormat($nombre_foto));

        if (!Laravel\File::exists($real_path_photo)) {
            throw new NotifierValidatorException('Ocurrio un error al subir la foto: "' . $nombre_foto . '"');
        }

        $album = $this->buscarPorNombreDeAlbum($nombre_album);
        $foto = new Foto();

        if (is_null($album)) {
            throw new NotifierValidatorException('El album: "' . $nombre_album . '" no existe, por tanto no se subira la foto.');
        }

        $foto->administradores_id = Auth::user()->id;
        $foto->albums_id = $album->id;
        $foto->nombre = $nombre_foto;
        $foto->descripcion = $descripcion;
        $foto->url = $url_foto;
        $foto->save();
    }

    public function actualizarPorTitulo($titulo, Album $album) {
        $validator = \Laravel\Validator::make(array('nombre' => $album->nombre), array('nombre' => 'required|unique:' . Album::$table));
        if ($validator->fails()) {
            return $validator;
        }
        $controlador = new AlbumController();
        $al = $controlador->buscarPorNombreDeAlbum($titulo);
        if (!is_null($al)) {
            return NotifierValidator::createError('');
        }
    }

    public function actualizarPorId($id, Album $album) {
        $album_actual = Album::find($id);
        if (is_null($album_actual)) {
            return NotifierValidator::createError('No se pudo actualizar los datos del Album');
        }
        
        if ($this->existeDirAlbum($album)) {
            return NotifierValidator::createError('Ya exiete una carpeta con el mismo nombre, probablemente no este dado de alta en el sistema.');
        }

        $new_name = $this->getDirName($album);
        if (!$this->renombrarAlbum($new_name, $album_actual)) {
            return NotifierValidator::createError('Ocurrio un error al renombrar la carpeta del álbum.');
        }

        $album_actual->nombre = $album->nombre;
        $album_actual->descripcion = $album->descripcion;
        $album_actual->url = self::ALBUMS_PATH . $new_name;
        $foto_cont = new FotoController();
        $foto_cont->cambiarUrl($album_actual->id, $album_actual->url);
        $album_actual->save();

        return NotifierValidator::createValid();
    }

    private function renombrarAlbum($nuevo_nombre, Album $album) {
        $b = true;
        $path = self::REAL_ROOT . $this->getAlbumPath($album);
        $new_path = self::REAL_ROOT . self::ALBUMS_PATH . Format::textToDirFormat($nuevo_nombre);
        \Laravel\File::mkdir($new_path, 7777);
        $new_path .= "/";
        $f = new FilesystemIterator($path);
        while ($f->valid()) {
            $file_name = $f->getFilename();
            $path_file = $path . "/" . $file_name;
            $new_path_file = $new_path . $file_name;
            if (\Laravel\File::exists($path_file)) {
                if (\Laravel\File::exists($new_path)) {
                    \Laravel\File::move($path_file, $new_path_file);
                } else {
                    return false;
                }
            } else {
                return false;
            }
            $f->next();
        }
        \Laravel\File::rmdir($path);
        if (\Laravel\File::exists($path)) {
            return false;
        }
        return $b;
    }

    private function existeDirAlbum(Album $album) {
        return \Laravel\File::exists(self::REAL_ROOT . $this->getAlbumPath($album));
    }

}

?>
