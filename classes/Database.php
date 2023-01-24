<!-- detta är databasen -->
<?php

class Database{
    private $host = "localhost";
    private $user = "root";
    private $pass = "root";
    private $db = "arkeologibas";
    
    protected $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        if(!$this->conn){
            die("Error connecting to db");
        }
    }
}