<?php

 use \Psr\Http\Message\ServerRequestInterface as Request;
 use \Psr\Http\Message\ResponseInterface as Response;


 function addjacker( Request $request, Response $response ) {

   header('Content-type: application/json');
   header('Access-Control-Allow-Origin: *');

   $response = shell_exec('./utils/convertJson2Hex.sh');

   echo json_encode( $response );

   //echo json_encode( $request->getParsedBody()['imageId'] );

   exit;

 }

?>
