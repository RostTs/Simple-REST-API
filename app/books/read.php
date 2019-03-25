<?php
// DEFINE HEADERS
 header('Access-Control-Allow-Origin:  *');
 header('Content-Type: application/json');

// INCLUDE CONFIG/MODELS
  include_once '../../config/db_conn.php';
  include '../../models/Books.php';

// CREATE DB OBJECTC
  $database = new DataBase();
  $db = $database->connect();

// CREATE BOOKS OBJECT
  $books = new Books($db);
 
  // CALL A READ METHOD
  $result = $books->read();
  $num = $result->rowCount();

  // CHECK IF ANY RESULTS
  if ($num > 0) {
  $booksArray = array();

  // FETCH DATA FROM DATABASE 
  while($row = $result->fetch(PDO::FETCH_LAZY)){

    // EXTRACT RECEIVED DATA TO VARIABLES
     extract(get_object_vars($row));

     // COMPACTING  DATA TO ARRAY
     $values = array(
         'id' => htmlspecialchars($id),
         'category_id' => htmlspecialchars($category_id),
         'book_name' => htmlspecialchars($book_name),
         'book_subject' => htmlspecialchars($book_subject),
         'author' => htmlspecialchars($author),
         'date_created' => htmlspecialchars($date_created),
         'category_name' => htmlspecialchars($category_name)
     );
      array_push($booksArray,$values);
  };
   
  // ENCODE AND SHOW DATA
  $output = json_encode($booksArray);
  echo $output;

  // SHOW ERROR INFO
} else {
    echo json_encode(
        array('message' => 'No Books Found')
    );
};