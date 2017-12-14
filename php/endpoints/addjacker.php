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
     public $lastName;
     public $dob;
     public $height;
     public $weight;

     function __construct($image,$imageId,$firstName,$lastName,$dob,$height,$weight) {
       $this->image = $image;
       $this->imageId = $imageId;
       $this->firstName = $firstName;
       $this->lastName = $lastName;
       $this->dob = $dob;
       $this->height = $height;
       $this->weight = $weight;
     }
   }

   $image     = $request->getParsedBody()['image'];
   $imageId   = $request->getParsedBody()['imageId'];
   $firstName = $request->getParsedBody()['firstName'];
   $lastName  = $request->getParsedBody()['lastName'];
   $dob       = $request->getParsedBody()['dob'];
   $height    = $request->getParsedBody()['height'];
   $weight    = $request->getParsedBody()['weight'];

   $jacker = new Jacker($image,$imageId,$firstName,$lastName,$dob,$height,$weight);

   $raw_hex = shell_exec('./endpoints/utils/convertJson2Hex.sh ' . json_encode( $jacker ));
   $lines = explode(" ",$raw_hex);
   $hex = "";

   foreach ($lines as $line) {
     $hex .= $line;
   }

   //$response->getBody()->write( json_encode( $hex ) );
   $response->getBody()->write( json_encode( '{image:perp1.jpg,imageId:Zn58IAgY2VBy9kV0I5Hsqydj,firstName:Victor,lastName:Green,dob:02-01-1976,height:5ft 11in,weight:170lbs}' ) );

 }

?>
