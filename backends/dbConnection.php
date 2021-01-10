<?php 

class Database {

    private $db_host = "localhost";
    private $db_user = "root";
    private $db_pass = "";
    private $db_name = "img_crud";

    protected $conn = null ;

    public function __construct(){
        try {
           $this->conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name",$this->db_user,$this->db_pass);
           $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Connection Failed...' . $e->getMessage());
        }
    }

    public function __destruct(){
        $this->conn = null;
    }
}

?>