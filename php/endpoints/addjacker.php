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
   $imageType = $imgParts[1];
   $imageId   = $request->getParsedBody()['imageId'];
   $firstName = $request->getParsedBody()['firstName'];
   $lastName  = $request->getParsedBody()['lastName'];
   $dob       = $request->getParsedBody()['dob'];
   $height    = $request->getParsedBody()['height'];
   $weight    = $request->getParsedBody()['weight'];

   // Begin Jacker Data
   $jacker_key = "";
   $jacker_key .= $lastName . "-" . $firstName . "-" . $dob;
   $jacker = new Jacker($imageType,$imageId,$firstName,$lastName,$dob,$height,$weight);

   $raw_hex = shell_exec('./endpoints/utils/convertJson2Hex.sh ' . json_encode( $jacker ));
   $lines = explode(" ",$raw_hex);
   $jacker_hex = "";

   foreach ($lines as $line) {
     $jacker_hex .= $line;
   }

   $jacker_encoded = trim( $jacker_hex );
   $result1 = saveJacker($jacker_key,$jacker_encoded);
   // End Jacker Data

   // Begin Jacker Mugshot Data
   $jackerMugshot_key .= $imageId . "." . $imageType;
   $jackerMugshot_image = "./uploads/" . $image;
   $raw_hex = shell_exec('./endpoints/utils/convertImg2Hex.sh ' . $jackerMugshot_image );
   $lines = explode(" ",$raw_hex);
   $jacker_hex = "";

   foreach ($lines as $line) {
     $jacker_hex .= $line;
   }

   $jackerMugshot_encoded = trim( $jacker_hex );
   $result2 = saveJackerMugshot($jackerMugshot_key,$jackerMugshot_encoded);
   // End Jacker Mugshot Data

   $response->getBody()->write( json_encode( '{"status":"success","result1":"'.$result1.'","result2":"'.$result2.'","jacker-mugshot":"'.$jackerMugshot_encoded.'"}' ) );

 }


 function saveJacker($jacker_key,$jacker_encoded) {

   $service_url = 'http://blockchain:8000';
   $credentials = "privateblock:password";

   $curl = curl_init();
   curl_setopt( $curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC );
   curl_setopt( $curl, CURLOPT_USERPWD, $credentials );
   curl_setopt( $curl, CURLOPT_URL, $service_url );
   curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
   curl_setopt( $curl, CURLOPT_POST, true );
   curl_setopt( $curl, CURLOPT_POSTFIELDS, '{"method":"publish","params":["washington-dc_jackers","'.$jacker_key.'","'.$jacker_encoded.'"],"id":1,"chain_name":"Skynet"}' );
   curl_setopt( $curl, CURLOPT_HTTPHEADER, array('Content-Type: text/plain') );
   $curl_response = curl_exec($curl);

   if ($curl_response === false) {
       $info = curl_getinfo($curl);
       curl_close($curl);
       die('error occured during curl exec. Additioanl info: ' . var_export($info));
   }

   curl_close($curl);
   return $curl_response;
 }


 function saveJackerMugshot($jackerMugshot_key,$jackerMugshot_encoded) {

   $service_url = 'http://blockchain:8000';
   $credentials = "privateblock:password";

   $curl = curl_init();
   curl_setopt( $curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC );
   curl_setopt( $curl, CURLOPT_USERPWD, $credentials );
   curl_setopt( $curl, CURLOPT_URL, $service_url );
   curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
   curl_setopt( $curl, CURLOPT_POST, true );
   curl_setopt( $curl, CURLOPT_POSTFIELDS, '{"method":"publish","params":["washington-dc_mugshots","'.$jackerMugshot_key.'","'.$jackerMugshot_encoded.'"],"id":1,"chain_name":"Skynet"}' );
   curl_setopt( $curl, CURLOPT_HTTPHEADER, array('Content-Type: text/plain') );
   $curl_response = curl_exec($curl);

   if ($curl_response === false) {
       $info = curl_getinfo($curl);
       curl_close($curl);
       die('error occured during curl exec. Additioanl info: ' . var_export($info));
   }

   curl_close($curl);
   return $curl_response;
 }

?>
