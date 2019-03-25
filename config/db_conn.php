<?php
 class DataBase {

  // DB PARAMS
  private $host = 'localhost';
  private $db_name = 'books_api';
  private $username = 'root';
  private $password = 'root';
  private $conn = '';

  // DB CONNECT
   public function connect() {
    $this->conn = null;

    try {                                                   
      $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name,
                             $this->username,
                             $this->password);
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $this->conn;
    } catch(PDOExeption $e) {
         echo "There is an error " . $e->getMessage;
    } 

   }

 };