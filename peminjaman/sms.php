<?php

$nomor = $_POST['nomor'];
$pesan = $_POST['pesan'];

$ch = curl_init('https://textbelt.com/text');
$data = array(
  'phone' => $nomor,
  'message' => $pesan,
  'key' => '6525854a417fe6b45afcbc4c19e3936a5062ef7a22vx11NaeoO1POi6lwhajRPKS',
);

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

include "../vendor/autoload.php";

use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Model\SendMessageRequest;

// Configure client
$config = Configuration::getDefaultConfiguration();
$config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU1NjIyMDUyMywiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjYzMjA3LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.TxSPGIZqTbeKu_vcN0jGdX04eZ0DoTt-dhn1fwI82jc');
$apiClient = new ApiClient($config);
$messageClient = new MessageApi($apiClient);

//$clients = new SMSGatewayMe\Client\ClientProvider("eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU1NjIyMDUyMywiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjYzMjA3LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.TxSPGIZqTbeKu_vcN0jGdX04eZ0DoTt-dhn1fwI82jc");

$sendMessageRequest = new SMSGatewayMe\Client\Model\SendMessageRequest([
    'phoneNumber' => $nomor, 'message' => $pesan, 'deviceId' => 104188
]);

$sentMessages = $messageClient->sendMessages([$sendMessageRequest]);

?>