<?php

 use \Psr\Http\Message\ServerRequestInterface as Request;
 use \Psr\Http\Message\ResponseInterface as Response;

 class Jacker {
   function Jacker() {
     $this->image = "";
     $this->imageId = "";
     $this->firstName = "";
   }
 }


 function addjacker( Request $request, Response $response ) {

   header('Content-type: application/json');
   header('Access-Control-Allow-Origin: *');

   $jacker = new Jacker();

   $jacker.image = $request->getParsedBody()['image'];
   $jacker.imageId = $request->getParsedBody()['imageId'];
   $jacker.firstName = $request->getParsedBody()['firstName'];

   $hex = shell_exec('./endpoints/utils/convertJson2Hex.sh');

   $response->getBody()->write( json_encode( $jacker ) );

 }

?>
