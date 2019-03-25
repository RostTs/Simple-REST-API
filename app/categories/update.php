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
    "id": "1",
    "name" : "name" 
}' . "\n";

// GETTING DATA FROM BODY
  $data = file_get_contents('php://input');

   // DECODING BODY INFO TO A STRING
  $result = json_decode($data);
  if (!$result == null) {
        $categories->id = $result->id;

         $output = $categories->read_single();
         $num = $output->rowCount();

       // CHECKING IF CATEGORY EXISTS IN DATABASE
         if ($num > 0) {
            $categories->name = $result->name;

        // CALLING UPDATE METHOD
            $update = $categories->update();

          // SHOW SUCCCESS INFO
            echo json_encode(
                array('message' => 'Success! Category updated')
            );
            
            // SHOW ERROR INFO
         } else {
            echo json_encode(
                array('message' => 'No id exists!')
            );
            die();
         }
   
         // SHOW ERROR INFO
  } else {
    echo json_encode(
        array('message' => 'Something wrong!')
    );
  }