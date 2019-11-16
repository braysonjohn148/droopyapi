<?php
class Database{

    private $host = "localhost";
    private $db_name = "droopy";
    private $username = "droopy";
    private $password = "droopy";
    public $conn;
  
    // get the database connection

    //static
    public  function getConnection(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}
?>
