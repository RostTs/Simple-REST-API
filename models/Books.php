<?php

 class Books {
 
  // DB CREDENTIALS
     private $conn;
     private $table = 'books';

      //  BOOKS PROPERTIES
     public $id;
     public $category_id;
     public $book_name;
     public $book_subject;
     public $author;
     public $date_created;
     public $category_name;

  //   COMMUNICATION WITH DB
     public function __construct($db) {
       $this->conn = $db;
     }

      // GET ALL AVAILABLE BOOKS
     public function read() {
       
 // CREATE A QUERY
        $query = 'SELECT c.name as category_name, 
                  b.id,
                  b.category_id, 
                  b.book_name, 
                  b.book_subject, 
                  b.author, 
                  b.date_created 
                  FROM ' . $this->table . ' b   
                  LEFT JOIN categories c ON c.id = b.category_id
                  ORDER BY b.date_created DESC';

     // PREPARE STATEMENT
    $stmt = $this->conn->prepare($query);

    // EXECUTE QUERY
    $stmt->execute();
    return $stmt; 
  }

         // GET SINGLE BOOK
        public function read_single() {

 // CREATE A QUERY
          $query = 'SELECT c.name as category_name, 
                    b.id,
                    b.category_id, 
                    b.book_name, 
                    b.book_subject, 
                    b.author, 
                    b.date_created 
                    FROM ' . $this->table . ' b   
                    LEFT JOIN categories c ON c.id = b.category_id
                    WHERE b.id = ?';

       // PREPARE STATEMENT
      $stmt = $this->conn->prepare($query);

      // BIND REQUESTED ID
      $stmt->bindParam(1,$this->id);

      // EXECUTE QUERY
      $stmt->execute();
      return $stmt;
   }

           // CREATE NEW BOOK
           public function create() {

        // CREATE A QUERY
          $query = 'INSERT INTO ' . $this->table . '
                    SET category_id = :cat_id, 
                    book_name = :name, 
                    book_subject = :subject, 
                    author = :author';

          // CLEAN DATA
           $category_id = htmlspecialchars(strip_tags($this->category_id));
           $book_name = htmlspecialchars(strip_tags($this->book_name));
           $author = htmlspecialchars(strip_tags($this->author));
           $subject = htmlspecialchars(strip_tags($this->subject));

         // PREPARE STATEMENT
             $stmt = $this->conn->prepare($query);

           // BIND REQUESTED ID
             $stmt->bindParam(':cat_id', $category_id);
             $stmt->bindParam(':name',$book_name);
             $stmt->bindParam(':subject',$subject);
             $stmt->bindParam(':author',$author);

             // EXECUTE QUERY
             $stmt->execute();
             return $stmt;
        }
    
        // UPDATE BOOK
          public function update() {

         // CREATE A QUERY
            $query = 'UPDATE ' . $this->table . '
                      SET category_id = :cat_id, 
                      book_name = :name, 
                      book_subject = :subject, 
                      author = :author
                      WHERE id = :id';

          // CLEAN DATA
          $id = htmlspecialchars(strip_tags($this->id));
           $category_id = htmlspecialchars(strip_tags($this->category_id));
           $book_name = htmlspecialchars(strip_tags($this->book_name));
           $author = htmlspecialchars(strip_tags($this->author));
           $subject = htmlspecialchars(strip_tags($this->subject));

         // PREPARE STATEMENT
             $stmt = $this->conn->prepare($query);

         // BIND REQUESTED ID
             $stmt->bindParam(':id', $id);
             $stmt->bindParam(':cat_id', $category_id);
             $stmt->bindParam(':name',$book_name);
             $stmt->bindParam(':subject',$subject);
             $stmt->bindParam(':author',$author);

             // EXECUTE QUERY
             $stmt->execute();
             return $stmt;
          }

           // DELETE BOOK
          public function delete() {

            // CREATE QUERY
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

 