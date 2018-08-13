<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);




 class Usuario
 {

    private $id;
    private $name;
    private $lastname;
    private $dni;
    private $codigo;
    private $telefono;
    private $usuario;
    private $email;
    private $pwd;
    private $avatar;


    function __construct($name,$lastname,$dni,$codigo,$telefono,$usuario,$email,$pwd,$avatar,$id=null)
    {
      $this->id = trim($id);
      $this->name = trim($name);
      $this->lastname = trim($lastname);
      $this->dni = trim($dni);
      $this->codigo = trim($codigo);
      $this->telefono = trim($telefono);
      $this->usuario = trim($usuario);
      $this->email = trim($email);
      $this->pwd = trim($pwd);
      $this->avatar = trim($avatar);

    }



          public function Validar($rpwd)
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
                  }elseif($this->ValidarEmail()){
                    $errores[] = "El mail ya se encuentra registrado";
                  }
                  if($this->pwd != $rpwd){
                     $errores[]= "las contraseñas deben coincidir ";
                 }
                     return $errores;
                  }



           public function validarEmail(){
           include 'conn.php';


           $consulta = "select count(*) from movies_db.usuarios where email = '{$this->email}'";
           $resultado = $db->query($consulta);
           $existe = 0;
           foreach ($resultado as $registro) {
           $existe = $registro[0];
           }
           return $existe;
         }



          public function guardarUsuario()
          {
            include 'conn.php';
           try {
             $phash = password_hash(trim($this->pwd),PASSWORD_DEFAULT);
             $sql = "INSERT INTO movies_db.usuarios (name, email, password,role) VALUES ('{$this->name}','{$this->email}','{$phash}','1')";
             $query = $db->prepare($sql);
             $query->execute();
           }
           catch( PDOException $Exception ){
           }
         }




         public function  validarLogueo(){
            $errores = [];

            if(!$this->validarEmail()){
               $errores [] = 'Verificar email ingresado';
            }elseif(!$this->validarPassword()){
             $errores[] = 'La contraseña es incorrecta';

            }
             return $errores;

         }

       private function validarPassword(){
         include("conn.php");
        $busqueda = "SELECT * FROM movies_db.usuarios WHERE email = {$this->email}";
        $consultaSql = $db->prepare($busqueda);
        $consultaSql->execute();
        $resultado = $consultaSql->fetch(PDO::FETCH_ASSOC);

         if(count($resultado)==1)
         {
           foreach ($resultado as $registro) {
            if(password_verify($this->password,$registro['password'])){
              return true;
            }
         }
        return false;
       }


       }

       public function getId() {
         return $this->id;
        }

        public function getName(){
          return $this->name;
        }
        public function getLastname(){
          return $this->name;
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


        public function getUsuario(){
          return $this->usuario;
        }


        public function getEmail(){
          return $this->email;
        }


        public function getPwd(){
          return $this->pwd;
        }

        public function getAvatar(){
          return $this->avatar;
        }





    }

?>
