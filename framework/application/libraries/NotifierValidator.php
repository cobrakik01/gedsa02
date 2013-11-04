<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AlbumValidator
 *
 * @author cobrakik
 */
class NotifierValidator extends \Laravel\Validator {
    /*
      public function __construct($attributes, $rules, $messages = array()) {
      parent::__construct($attributes, $rules, $messages);
      }
     */

    public function validate_error($attribute, $value, $parameters) {
        return $value;
    }

    public static function createError($mensaje, $atributo = 'errores') {
        if ($atributo == "") {
            $atributo = 'errores';
        }
        return static::create($mensaje, $atributo, false);
    }

    private static function create($mensaje, $atributo, $b) {
        $v = NotifierValidator::make(array($atributo => $b), array($atributo => 'error'), array('error' => $mensaje));
        $v->fails();
        return $v;
    }

    public static function createValid() {
        return static::create('Default_NotifierValidator', 'Default_NotifierValidator', true);
    }

}

?>
