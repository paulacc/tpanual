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
    private $email;
    private $pwd;
    private $avatar;

    
    //aca solo debe ir los datos que sean obligatorios constructor
  
    function __construct($name,$lastname,$email)
    {
      $this->setName($name);
      $this->lastname = trim($lastname);
      $this->email = trim($email);
      //$this->setPwd($pwd);
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
                  }elseif($this->validarEmail()){
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
             $sql = "INSERT INTO movies_db.usuarios (name, email, password) VALUES ('{$this->name}','{$this->email}','{$phash}')";
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
            if(password_verify($this->password,$registro['pwd'])){
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


    


        public function getEmail(){
          return $this->email;
        }


        public function getPwd(){
          return $this->pwd;
        }

        public function getAvatar(){
          return $this->avatar;
        }

        
        
    
        
        public function setId($id){
              $this->id = trim($id);
        }
        public function setName($name){
          $this->name = trim($name);
        }
        
        public function setLastname($lastname){
          $this->lastname = trim($lastname);
        }
        
        public function setDni($dni){
          $this->dni = trim($dni);
        }
        
        
        public function setCodigo($codigo){
          $this->codigo = trim($codigo);
        }
        
        
        public function setTelefono($telefono){
          $this->telefono = trim($telefono);
        }
        
        
        public function setEmail($email){
          $this->email = trim($email);
        }
        
        public function setAvatar($avatar){
          $this->avatar = trim($avatar);
        }
        
        public function setPwd($pwd){
          $this->pwd =  password_hash($pwd, PASSWORD_DEFAULT);
        }
  
        
        
        





    }

?>
