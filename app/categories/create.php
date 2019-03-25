<?php
// DEFINE HEADERS
 header('Access-Control-Allow-Origin:  *');
 header('Access-Control-Allow-Method: POST');
 header('Content-Type: application/json');

// INCLUDE CONFIG/MODELS
  include_once '../../config/db_conn.php';
  include '../../models/Categories.php';

// CREATE DB OBJECTC
  $database = new DataBase();
  $db = $database->connect();

// CREATE CATEGORY OBJECT
  $categories = new Categories($db);

  // OUTPUTTING EXAMPLE FOR NEW CATEGORY
   echo '{
"Here an exaple of input you can use (Delete this first string)!"
    "name": "name"
}' . "\n";

// GETTING DATA FROM BODY
  $data = file_get_contents('php://input');

  // DECODING BODY INFO TO A STRING
  $result = json_decode($data);
  if (!$result == null) {

        // DEFINING PROPERTIES FOR NEW CATEGORY
        $categories->name = $result->name;

  // CALLING A CREATE METHOD
    $create = $categories->create();

  // SHOWING SUCCESS INFO
    echo json_encode(
        array('message' => 'Success! New Category added')
    );
    
    // SHOWING ERROR INFO
  } else {
    echo json_encode(
        array('message' => 'Something wrong!')
    );
  }