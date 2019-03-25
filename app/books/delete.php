<?php
// DEFINE HEADERS
 header('Access-Control-Allow-Origin:  *');
 header('Access-Control-Allow-Method: DELETE');
 header('Content-Type: application/json');

// INCLUDE CONFIG/MODELS
  include_once '../../config/db_conn.php';
  include '../../models/Books.php';

// CREATE DB OBJECTC
  $database = new DataBase();
  $db = $database->connect();

// CREATE BOOKS OBJECT
  $books = new Books($db);

  // GET ID OF BOOK 
  if (isset($_GET['id'])) {
       $books->id = $_GET['id'];

     // CHECK IF BOOK EXISTS IN DATABASE
       $output = $books->read_single();
         $num = $output->rowCount();
         if ($num > 0) {

          // CALL A DELETE BOOK METHOD
            $books->delete();

          // SHOW SUCCESS INFO
            echo json_encode(
             array('message' => 'Book deleted!')
         );

         // SHOW ERROR INFO
         } else {
            echo json_encode(
                array('message' => 'Book not exists!')
            );
         }
      
  // SHOW ERROR INFO
   } else {
    echo json_encode(
        array('message' => 'No id exists!')
    );
   };

