<?php

 use \Psr\Http\Message\ServerRequestInterface as Request;
 use \Psr\Http\Message\ResponseInterface as Response;


 function addjacker( Request $request, Response $response ) {

   header('Content-type: application/json');
   header('Access-Control-Allow-Origin: *');

   class Jacker {

     public $imageType;
     public $imageId;
     public $firstName;
     public $lastName;
     public $dob;
     public $height;
     public $weight;

     function __construct($imageType,$imageId,$firstName,$lastName,$dob,$height,$weight) {
       $this->imageType = $imageType;
       $this->imageId = $imageId;
       $this->firstName = $firstName;
       $this->lastName = $lastName;
       $this->dob = $dob;
       $this->height = $height;
       $this->weight = $weight;
     }
   }

   $image     = $request->getParsedBody()['image'];
   $imgParts  = explode(".",$image);
   $imageType = $imageType[1];
   $imageId   = $request->getParsedBody()['imageId'];
   $firstName = $request->getParsedBody()['firstName'];
   $lastName  = $request->getParsedBody()['lastName'];
   $dob       = $request->getParsedBody()['dob'];
   $height    = $request->getParsedBody()['height'];
   $weight    = $request->getParsedBody()['weight'];

   $jacker = new Jacker($imageType,$imageId,$firstName,$lastName,$dob,$height,$weight);

   $raw_hex = shell_exec('./endpoints/utils/convertJson2Hex.sh ' . json_encode( $jacker ));
   $lines = explode(" ",$raw_hex);
   $hex = "";

   foreach ($lines as $line) {
     $hex .= $line;
   }

   $response->getBody()->write( json_encode( $hex ) );

 }

?>
