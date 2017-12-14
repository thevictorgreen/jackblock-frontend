<?php

 use \Psr\Http\Message\ServerRequestInterface as Request;
 use \Psr\Http\Message\ResponseInterface as Response;


 function addjacker( Request $request, Response $response ) {

   header('Content-type: application/json');
   header('Access-Control-Allow-Origin: *');

   // $item = $request->getParsedBody()['gititem'];

   $hex = shell_exec('./endpoints/utils/convertJson2Hex.sh');

   $response->getBody()->write( $hex );

   //json_encode( '{"test":"test"}' );

 }

?>
