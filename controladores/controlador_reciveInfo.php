<?php
require_once '../vendor/autoload.php';
$id_token = $_POST['credential'];

$client = new Google_Client(['client_id' => '836597504080-i9kk56qtd4p2ljtlol2igvd7e7ocduf0.apps.googleusercontent.com']);  // Specify the CLIENT_ID of the app that accesses the backend

$payload = $client->verifyIdToken($id_token);
if ($payload) {
  echo json_encode(['email'=>$payload['email'],'name'=>$payload['given_name'],'last name'=>$payload['family_name'],'picture'=>$payload['picture']]);
} else {
  echo json_encode(['error'=>'Invalid ID token']);
}

?>