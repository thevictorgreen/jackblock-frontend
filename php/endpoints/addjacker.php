<?php

 use \Psr\Http\Message\ServerRequestInterface as Request;
 use \Psr\Http\Message\ResponseInterface as Response;


 function addjacker( Request $request, Response $response ) {

   header('Content-type: application/json');
   header('Access-Control-Allow-Origin: *');

   class Jacker {

     public $image;
     public $imageId;
     public $firstName;

     function __construct($image,$imageId,$firstName) {
       $this->image = $image;
       $this->imageId = $imageId;
       $this->firstName = $firstName;
     }
   }

   $image = $request->getParsedBody()['image'];
   $imageId = $request->getParsedBody()['imageId'];
   $firstName = $request->getParsedBody()['firstName'];
   $jacker = new Jacker($image,$imageId,$firstName);

   $hex = shell_exec('./endpoints/utils/convertJson2Hex.sh ' . json_encode( $jacker ));

   $response->getBody()->write( json_encode( $hex ) );

 }

?>
