<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);




 class Usuario
 {

    private $id;
    private $name;
    private $dni;
    private $codigo;
    private $telefono;
    private $usuario;
    private $email;
    private $pwd;
    private $avatar;


    function __construct($name,$dni,$codigo,$telefono,$usuario,$email,$pwd,$avatar,$id=null)
    {
      $this->id = trim($id);
      $this->name = trim($name);
      $this->dni = trim($dni);
      $this->email = trim($codigo);
      $this->email = trim($telefono);
      $this->email = trim($usuario);
      $this->email = trim($email);
      $this->pwd = trim($pwd);
      $this->role = trim($avatar);

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



           public function ValidarEmail(){
           include 'conexion.php';


           $consulta = "select count(*) from movies_db.users where email = '{$this->email}'";
           $resultado = $db->query($consulta);
           $existe = 0;
           foreach ($resultado as $registro) {
           $existe = $registro[0];
           }
           return $existe;
         }



          public function GuardarUsuario()
          {
            include 'conexion.php';
           try {
             $phash = password_hash(trim($this->pwd),PASSWORD_DEFAULT);
             $sql = "INSERT INTO movies_db.users (name, email, password,role) VALUES ('{$this->name}','{$this->email}','{$phash}','1')";
             $query = $db->prepare($sql);
             $query->execute();
           }
           catch( PDOException $Exception ){
           }
         }




         public function  validarLogueo(){
            $errores = [];

            if(!$this->ValidarEmail()){
               $errores [] = 'Verificar email ingresado';
            }elseif(!$this->validarPassword()){
             $errores[] = 'La contraseña es incorrecta';

            }
             return $errores;

         }

       private function validarPassword(){
         include("conexion.php");
        $busqueda = "SELECT * FROM movies_db.users WHERE email = {$this->email}";
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

        public function getEmail(){
          return $this->email;
        }

        public function getPwd(){
          return $this->pwd;
        }

        public function getRole(){
          return $this->role;
        }





    }

?>
