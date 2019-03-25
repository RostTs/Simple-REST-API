<?php
// DEFINE HEADERS
 header('Access-Control-Allow-Origin:  *');
 header('Access-Control-Allow-Method: POST');
 header('Content-Type: application/json');

// INCLUDE CONFIG/MODELS
  include_once '../../config/db_conn.php';
  include '../../models/Books.php';

// CREATE DB OBJECTC
  $database = new DataBase();
  $db = $database->connect();

// CREATE BOOKS OBJECT
  $books = new Books($db);

  // OUTPUTTING EXAMPLE FOR THE BOOK
   echo '{
"Here an exaple of input you can use (Delete this first string)!"
    "id": "1",
    "cat_id" : "5" ,
    "book_name": "book_name",
    "author": "author",
    "subject": "subject"
}' . "\n";

// GETTING DATA FROM BODY
  $data = file_get_contents('php://input');

  // DECODING BODY INFO TO A STRING
  $result = json_decode($data);
 
  if (!$result == null) {
        $books->id = $result->id;

         $output = $books->read_single();
         $num = $output->rowCount();

        // CHECK IF BOOK EXISTS IN DATABASE
         if ($num > 0) {

             // DEFINING PROPERTIES FOR THE BOOK
            $books->category_id = $result->cat_id;
            $books->book_name = $result->book_name;
            $books->author = $result->author;
            $books->subject = $result->subject;

            // CALL UPDATE METHOD
            $update = $books->update();

            // SHOWING SUCCESS INFO
            echo json_encode(
                array('message' => 'Success! Book updated')
            );
         } else {

            // SHOWING ERROR INFO
            echo json_encode(
                array('message' => 'No id exists!')
            );
            die();
         }
   
 // SHOWING ERROR INFO
  } else {
    echo json_encode(
        array('message' => 'Something wrong!')
    );
  }