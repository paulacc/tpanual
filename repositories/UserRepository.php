<?php
  class UserRepository{

    private $user = 'paula';
    private $pass = 'paula';
    private $database = 'paula';
    private $table = 'users';
    private $opt = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

    private $db;

    public function __construct(){
        $this->connect();
    }

    public function connect()
    {
      try
      {
        $this->db = new PDO(
          "mysql:host=127.0.0.1;dbname={$this->database};port=3306",
          $this->user,
          $this->pass,
          $this->opt
        );
      }
      catch(PDOException $Exception)
      {
        echo $Exception->getMessage();
      }
    }

    public function save($user){
      try {
        $sql = "INSERT INTO {$this->table} ('name', 'lastname', 'dni', 'codigo', 'telefono', 'email', 'pwd')
        VALUES ({$user->getName()},{$user->getLastname()},{$user->getDni()},{$user->getCodigo()},{$user->getTelefono()},{$user->getEmail()},{$user->getPwd()})";
        print_r($sql);
        $query = $this->db->prepare($sql);
        $query->execute();
      }
      catch( PDOException $Exception ){
      }
    }

    public function fetchByEmail($email){
      $stmt = $this->db->prepare("select * from users where email = '{$email}'");

      //$stmt = $this->db->prepare("SELECT name FROM mytable WHERE id=4 LIMIT 1");
      $stmt->execute();

      return $stmt->fetch();
    }

  }
 ?>
