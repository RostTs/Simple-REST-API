<?php
// DEFINE HEADERS
 header('Access-Control-Allow-Origin:  *');
 header('Access-Control-Allow-Method: DELETE');
 header('Content-Type: application/json');

// INCLUDE CONFIG/MODELS
  include_once '../../config/db_conn.php';
  include '../../models/Categories.php';

// CREATE DB OBJECTC
  $database = new DataBase();
  $db = $database->connect();

// CREATE CATEGORY OBJECT
  $categories = new Categories($db);

 // GET ID OF CATEGORY
  if (isset($_GET['id'])) {
       $categories->id = $_GET['id'];

    // CHECK IF CATEGORY EXISTS IN DATABASE
       $output = $categories->read_single();
         $num = $output->rowCount();

         if ($num > 0) {

           // CALL A DELETE CATEGORY METHOD
            $categories->delete();

            // SHOW SUCCESS INFO
            echo json_encode(
             array('message' => 'Category deleted!')
         );

         // SHOW ERROR INFO
         } else {
            echo json_encode(
                array('message' => 'Category not exists!')
            );
         }
      
 // SHOW ERROR INFO
   } else {
    echo json_encode(
        array('message' => 'No id exists!')
    );
   };

