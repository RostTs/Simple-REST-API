<?php
// DEFINE HEADERS
 header('Access-Control-Allow-Origin:  *');
 header('Content-Type: application/json');

// INCLUDE CONFIG/MODELS
  include_once '../../config/db_conn.php';
  include_once '../../models/Categories.php';

// CREATE DB OBJECTC
  $database = new DataBase();
  $db = $database->connect();

  // CREATE CATEGORY OBJECT
  $categories = new Categories($db);

 // CALL A READ METHOD
  $result = $categories->read();
  $num = $result->rowCount();

  // CHECK IF THERE IS ANY CATEGORIES
  if ($num > 0) {
  $catArray = array();

  // FETCH DATA FROM DATABASE
  while($row = $result->fetch(PDO::FETCH_LAZY)){

      // EXTRACT RECEIVED DATA TO VARIABLES
     extract(get_object_vars($row));

      // COMPACTING  DATA TO ARRAY
     $values = array(
         'id' => htmlspecialchars($id),
         'name' => htmlspecialchars($name),
         'created_at' => htmlspecialchars($created_at),
     );
      array_push($catArray,$values);
  };

   // ENCODE AND SHOW DATA
  $output = json_encode($catArray);
  echo $output;

  // SHOW ERROR INFO
} else {
    echo json_encode(
        array('message' => 'No Books Found')
    );
};