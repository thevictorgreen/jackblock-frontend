<?php

  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  // DECLARE ENDPOINTS HERE
  require './endpoints/replay.php';
  require './endpoints/states.php';
  require './endpoints/insurance.php';
  require './endpoints/cities.php';
  require './endpoints/pharmacies.php';

  // IMPORT
  require './vendor/autoload.php';

  // INIT
  $app = new \Slim\App;

  // CONNECT ROUTES TO ENDPOINTS
  $app->get('/hello/{name}', replay);
  $app->get('/states', states);
  $app->get('/insurance/{st_id}', insurance);
  $app->get('/cities/{st_id}', cities);
  $app->get('/pharmacies/{ct_id}', pharmacies);


  // RUN APPLICATION
  $app->run();

?>
