<?php

     function Validar()
      {
          $errores = [] ;

       if(empty($this->name)){
          $errores[] = "El campo nombre es obligatorio";
        }elseif (!ctype_alpha($this->name)){
              $errores[] = "El campo nombre solo debe contener letras";
       }if(empty($this->dni)){
             $errores[] = "El campo dni es obligatorio";
       }elseif (!is_numeric($this->dni)) {
             $errores[] = "El campo dni sólo debe contener números";
           }
        if($this->email == ''){
            $errores[]= "El campo email es obligatorio";
        }elseif(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
             $errores[] = 'El correo no es válido" ';
        }
        if(empty($this->email)){
            $errores[] = "Debes ingresar una contraseña ";
       }elseif ((strlen($this->pwd) < 3 )) {
          $errores[] = "La contraseña debe tener más de 3 caracteres ";
        }elseif($this->validarEmail()){
          $errores[] = "El mail ya se encuentra registrado";
        }
        if($this->pwd != $rpwd){
           $errores[]= "las contraseñas deben coincidir ";
       }
       if ($_FILES[$avatar]['error'] != UPLOAD_ERR_OK) {
         $errores['avatar'] = "Suba una foto por favor.";
         } else {
         $ext = strtolower(pathinfo($_FILES[$avatar]['name'], PATHINFO_EXTENSION));
         if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'JPG') {
           $errores['avatar'] = "Formatos de foto admitidos: JPG o PNG.";
         }
       }
           return $errores;
        }





 ?>
