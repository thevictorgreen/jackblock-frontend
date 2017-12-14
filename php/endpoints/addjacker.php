<?php

 use \Psr\Http\Message\ServerRequestInterface as Request;
 use \Psr\Http\Message\ResponseInterface as Response;


 function addjacker( Request $request, Response $response ) {

   header('Content-type: application/json');
   header('Access-Control-Allow-Origin: *');

   $image = $request->getAttribute('image');

   $hex = shell_exec('./endpoints/utils/convertJson2Hex.sh');

   $response->getBody()->write( json_encode( $image ) );

 }

?>
