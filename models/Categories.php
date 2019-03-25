<?php

 class Categories {

   // DB CREDENTIALS
     private $conn;
     private $table = 'categories';

//  BOOKS PROPERTIES
     public $id;
     public $name;
     public $created_at;

//   COMMUNICATION WITH DB
     public function __construct($db) {
       $this->conn = $db;
     }

    // GET ALL AVAILABLE CATEGORIES
     public function read() {

       // CREATE A QUERY 
        $query = 'SELECT * FROM ' . $this->table ; 

     // PREPARE STATEMENT
    $stmt = $this->conn->prepare($query);

    // EXECUTE QUERY
    $stmt->execute();
    return $stmt; 
  }

         // GET SINGLE CATEGORY
        public function read_single() {

          // CREATE A QUERY
          $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ?';
       
     // PREPARE STATEMENT
      $stmt = $this->conn->prepare($query);

       // BIND REQUESTED ID
      $stmt->bindParam(1,$this->id);

       // EXECUTE QUERY
      $stmt->execute();
      return $stmt;
   }

         // CREATE NEW CATEGORY 
           public function create() {

           // CREATE A QUERY
          $query = 'INSERT INTO ' . $this->table . '
                    SET name = :name';

          // CLEAN DATA
           $name = htmlspecialchars(strip_tags($this->name));

           // PREPARE STATEMENT
             $stmt = $this->conn->prepare($query);

           // BIND REQUESTED ID
             $stmt->bindParam(':name',$name);

             // EXECUTE QUERY
             $stmt->execute();
             return $stmt;
        }

         // UPDATE CATEGORY
          public function update() {

           // CREATE A QUERY
            $query = 'UPDATE ' . $this->table . '
                      SET name = :name
                      WHERE id = :id';

          // CLEAN DATA
           $id = htmlspecialchars(strip_tags($this->id));
            $name = htmlspecialchars(strip_tags($this->name));  

           // PREPARE STATEMENT
             $stmt = $this->conn->prepare($query);

           // BIND REQUESTED ID
             $stmt->bindParam(':id', $id);
             $stmt->bindParam(':name', $name);
                         
             // EXECUTE QUERY
             $stmt->execute();
             return $stmt;
          }

           // DELETE CATEGORY
          public function delete() {

            // CREATE A QUERY
            $query = 'DELETE FROM ' . $this->table . '
                      WHERE id = ?';

                     // PREPARE STATEMENT
                      $stmt = $this->conn->prepare($query);

                     // BIND REQUESTED ID
                      $stmt->bindParam(1,$this->id);
                      
                        // EXECUTE QUERY
                      $stmt->execute();
                      return $stmt;
          }
 }

 