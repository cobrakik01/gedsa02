<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NotifierValidatorException
 *
 * @author cobrakik
 */
class NotifierValidatorException extends Exception {

    public function getNotification($atributo = "") {
        return NotifierValidator::createError(parent::getMessage(), $atributo);
    }

}

?>
