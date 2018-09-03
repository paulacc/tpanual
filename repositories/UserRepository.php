<?php
  class UserRepository{

    private $user = 'paula';
    private $pass = 'paula';
    private $table = 'paula';
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
          "mysql:host=127.0.0.1;dbname={$this->table};port=3306",
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

    public function fetchByEmail($email){
      $stmt = $this->db->prepare("select * from users where email = '{$email}'");

      $stmt = $dbh->prepare("SELECT name FROM mytable WHERE id=4 LIMIT 1");
$stmt->execute();


      return $this->db->fetch($query);
    }

  }
 ?>
