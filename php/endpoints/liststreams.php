<?php

 use \Psr\Http\Message\ServerRequestInterface as Request;
 use \Psr\Http\Message\ResponseInterface as Response;


 function liststreams( Request $request, Response $response ) {

   header('Content-type: application/json');
   header('Access-Control-Allow-Origin: *');

   $service_url = 'http://blockchain:8000';
   $credentials = "privateblock:password";

   $curl = curl_init();

   curl_setopt( $curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC );
   curl_setopt( $curl, CURLOPT_USERPWD, $credentials );
   curl_setopt( $curl, CURLOPT_URL, $service_url );
   curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
   curl_setopt( $curl, CURLOPT_POST, true );
   curl_setopt( $curl, CURLOPT_POSTFIELDS, '{"method":"liststreams","params":[],"id":1,"chain_name":"Skynet"}' );
   curl_setopt( $curl, CURLOPT_HTTPHEADER, array('Content-Type: text/plain') );
   $curl_response = curl_exec($curl);


   if ($curl_response === false) {
       $info = curl_getinfo($curl);
       curl_close($curl);
       die('error occured during curl exec. Additioanl info: ' . var_export($info));
   }

   curl_close($curl);
   echo $curl_response;

   exit;

   //$decoded = json_decode($curl_response,true);

   /*if ( isset( $decoded["error"] ) ) {
        die('error occured: ' . $decoded["error"] );
   }*/

   //echo $decoded["result"]["nodeaddress"];
   //echo $decoded

 }

?>
