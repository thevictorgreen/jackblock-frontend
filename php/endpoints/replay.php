<?php

  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  function replay( Request $request, Response $response ) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Really dude?, $name");
    return $response;
  }

?>
