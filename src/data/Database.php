<?php 

namespace MyApp\Data;

class Database 
{
    private $servername = "localhost";

    private $username = "root";
    
    private $password = "";
    
    private $db = "dbtest";
    
    private $db_conn = null;

    public function __construct()
    {
        $database = mysqli_connect($this->servername, $this->username, $this->password,$this->db);
        
        if (!$database) {
            die("Connection failed: " . mysqli_connect_error());
            
        }else{
            $this->db_conn= $database;
        }
    }

    public function getUser($email){
        $sql = "SELECT * FROM users WHERE email ='".$email."'";
        $result = mysqli_query($this->db_conn, $sql);
        if ($result->num_rows > 0) {
            return mysqli_fetch_assoc($result);
        }else{
            return array();
        }
    }

    public function addUser($name,$email,$password){
        $sql = "INSERT INTO users (name, email, password) VALUES ('".$name."', '".$email."', '".$password."')";

        if (mysqli_query($this->db_conn, $sql)) {
            return 1;
        } else {
            return "Error: " . $sql . "<br>" . mysqli_error($this->db_conn);
        }
    }
}

?>