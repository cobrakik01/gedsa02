<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Message
 *
 * @author cobrakik
 */
class Message {

    const YES = 1;
    const YES_NO = 2;
    const YES_NO_CANCEL = 3;
    const BACK = "<button style='margin-top: 30px;' onClick='javascript:history.back()'> <-Regresar </button>";

    /**
     * 
     * @param string $message Contiene el mensaje a mostrar
     * @param string $titulo Contiene el titulo a mostrar[opcional]
     * @param string $subtitulo Contiene el subtitulo a mostrar[opcional]
     * @param string $option Contiene la opcion a mostrar[opcional] por defecto es Message::BACK que indica que regresara a la pagina anterior
     */
    public static function showMessage($message, $titulo = "", $subtitulo = "", $option = Message::BACK) {
        $head = ($titulo) ? "<h3> $titulo </h3>" : "";
        $subhead = ($subtitulo) ? "<div class='subtitle-message' style='margin-bottom: 30px;'> $subtitulo </div>" : "";
        $body = "<div style='font-size: 16px;'> $message </div>";
        $options = $option;
        $content = $head . $subhead . $body . $options;
        return Laravel\View::make('admin.message')->with('msg', $content);
    }

    /*
      public static function showInput($message, $titulo = "", $subtitulo = "", $option = self::ACCEPT) {

      }
     * 
     */
}
?>
