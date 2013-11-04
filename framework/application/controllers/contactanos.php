<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Contactanos_Controller extends Base_Controller {

    public function get_index() {
        return View::make('client.contactanos');
    }
    
    public function post_index(){
        $messages_errors = array('txtNombre_required'=>'El campo nombre es obligatorio',
            'txtApp_required' => 'El campo Apellido Paterno es obligatorio',
            'txtDescripcionSolicitud_required' => 'El campo descripcion es obligatorio',
            'txtTelefono_required' => 'El campo telefono es obligatorio',
            'txtTelefono_numeric' => 'El campo telefono deve ser numerico, sin espacios',
            'txtTelefono_min' => 'El campo telefono deve tener al menos 8 caracteres numericos',
            'txtTelefono_max' => 'El campo telefono deve tener maximo 13 caracteres numericos');
        $rulePhone = array('txtTelefono' => 'required|numeric');
        $validation = Laravel\Validator::make(\Laravel\Input::all(), $rulePhone, $messages_errors);
        
        if($validation->fails()){
            return Laravel\Redirect::back()->with_errors($validation->errors);
        }
        
        $rules = array('txtNombre'=>'required',
            'txtApp' => 'required',
            'txtTelefono' => 'required|min:8|max:13',
            'txtDescripcionSolicitud' => 'required');
        $inputs = \Laravel\Input::all();
        $validation = Laravel\Validator::make($inputs, $rules, $messages_errors);
        
        if($validation->fails()){
            return Laravel\Redirect::back()->with_errors($validation->errors);
        }
        
        $to = 'cobrakik01@hotmail.com';
        //$to = 'cobrakik';
        $subject = 'Taller de arquitectura GEDSA';
        $headers = "From: www.gedsa.com\r\n";
        // $headers .= "Reply-To: " . strip_tags($_POST['req-email']) . "\r\n";
        // $headers .= "CC: otrocorreo@hotmail.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $message = Laravel\View::make('client.mail')->with(\Laravel\Input::all());
        
        $enviado = false;
        $codigo_estado_envio = NotifierValidator::createError('Lo sentimos, su solicitud no fue enviada, esta accion esta temporalmente fuera de servicio.');
        if(mail($to, $subject, $message, $headers)){
            $enviado = true;
            $codigo_estado_envio = NotifierValidator::createError('Se envio su solicitud correctamente, en breve nos comunicaremos con usted!');
        }
        return Laravel\Redirect::back()->with_errors($codigo_estado_envio);
        
    }

}
?>
