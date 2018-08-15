<?php
class UserRegisterForm
{
  private $id;
  private $name;
  private $lastname;
  private $email;
  private $dni;
  private $codigo;
  private $telefono;
  private $avatar;
  private $pwd;
  private $rpwd;

  private $messages;

  //Metodo de construccion
  public function __construct($post, $files = null) {

    $this->id =  $post['id'] ?? 0;
    $this->name =  $post['name'] ?? '';
    $this->lastname =  $post['lastname'] ?? '';
    $this->email =  $post['email'] ?? '';
    $this->dni =  $post['dni'] ?? '';
    $this->codigo =  $post['codigo'] ?? '';
    $this->telefono =  $post['telefono'] ?? '';
    $this->avatar =  $files['avatar'] ?? [];
    $this->pwd =  $post['pwd'] ?? '';
    $this->rpwd =  $post['rpwd'] ?? '';
    $this->messages = [];

  }

   public function isValid() {


      // Name
      if (empty($this->name)) {
        $this->messages['name'] = "El campo nombre es obligatorio";
      } elseif (!ctype_alpha($this->name)) {
        $this->messages['name'] = "El campo nombre solo debe contener letras";
      }

      // DNI
      if (empty($this->dni)) {
        $this->messages['dni'] = "El campo dni es obligatorio";
      } elseif (!is_numeric($this->dni)) {
        $this->messages['dni'] = "El campo dni sólo debe contener números";
      }


      if ($this->email == '') {
        $this->messages['email']= "El campo email es obligatorio";
      } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
        $this->messages['email'] = 'El correo no es válido" ';
      }
      // falta validacion de email
    //  elseif ($this->validarEmail()) {
      //  $this->messages['email'] = "El mail ya se encuentra registrado";
      //}

      // Pass
      if (empty($this->pwd)) {
        $this->messages['pwd'] = "Debes ingresar una contraseña ";
      } elseif ((strlen($this->pwd) < 3 )) {
        $this->messages['pwd'] = "La contraseña debe tener más de 3 caracteres ";
      }

      if ($this->pwd != $this->rpwd) {
        $this->messages['pwd']= "las contraseñas deben coincidir ";
      }


      if($this->avatar){
        if ($this->avatar['error'] != UPLOAD_ERR_OK) {
          $this->messages['avatar'] = "Suba una foto por favor.";
        } else {
          $ext = strtolower(pathinfo($this->avatar['name'], PATHINFO_EXTENSION));
          if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'JPG') {
            $this->messages['avatar'] = "Formatos de foto admitidos: JPG o PNG.";
          }
        }
      }

      return empty($this->messages);
   }

    public function getMessages(){
      return $this->messages;
    }

    public function getId() {
      return $this->id;
    }

    public function getName(){
      return $this->name;
    }

    public function getLastname(){
      return $this->lastname;
    }

    public function getDni(){
      return $this->dni;
    }

    public function getCodigo(){
      return $this->codigo;
    }

    public function getTelefono(){
      return $this->telefono;
    }

    public function getEmail(){
      return $this->email;
    }

    public function getAvatar(){
      return $this->avatar;
    }

}


//Metodo de validacion
//Metodo de mensajes $this->messages


 ?>
