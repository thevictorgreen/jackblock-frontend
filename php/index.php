<?php

  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  // DECLARE ENDPOINTS HERE
  require './endpoints/replay.php';
  require './endpoints/getinfo.php';
  require './endpoints/liststreams.php';
  require './endpoints/addjacker.php';
  require './endpoints/addjackermugshot.php';

  // IMPORT
  require './vendor/autoload.php';

  // INIT
  $app = new \Slim\App;

  // CONNECT ROUTES TO ENDPOINTS
  $app->get('/hello/{name}', replay);
  $app->get('/getinfo', getinfo);
  $app->get('/liststreams', liststreams);
  $app->post('/addjacker', addjacker);
  $app->post('/addjackermugshot', addjackermugshot);



  // RUN APPLICATION
  $app->run();

?>
