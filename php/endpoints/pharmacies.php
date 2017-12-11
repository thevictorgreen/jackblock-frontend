<?php

  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;


  function pharmacies( Request $request, Response $response ) {

    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");

    // DATABASE CONNECTION CODE
    $db_host = getenv('DB_HOST');
    $db_name = getenv('DB_NAME');
    $db_user = getenv('DB_USER');
    $db_pass = getenv('DB_PASS');
    $db = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8mb4',$db_user,$db_pass);
    // DATABASE CONNECTION CODE

    $ct_id = $request->getAttribute('ct_id');
    $results = $db->query("Select * from gl_pharmacies where ct_id = " . $ct_id);

    echo json_encode( $results->fetchAll(PDO::FETCH_ASSOC)) ;

    exit;
  }

?>
