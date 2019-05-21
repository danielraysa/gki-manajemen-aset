<?php

    // SMSGateway.me
    include "vendor/autoload.php";

    use SMSGatewayMe\Client\ApiClient;
    use SMSGatewayMe\Client\Configuration;
    use SMSGatewayMe\Client\Api\MessageApi;
    use SMSGatewayMe\Client\Model\SendMessageRequest;

    // Configure client
    $config = Configuration::getDefaultConfiguration();
    $config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU1NjIyMDUyMywiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjYzMjA3LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.TxSPGIZqTbeKu_vcN0jGdX04eZ0DoTt-dhn1fwI82jc');
    $apiClient = new ApiClient($config);
    $messageClient = new MessageApi($apiClient);

    // SMSGateway24
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://smsgateway24.com/getdata/addsms",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => false,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => array('token' => '98f12c3901caf3d013606ddb372347aa','sendto' => '087775905330','body' => 'Super Puper message TESTING GATEWAT','device_id' => '646'),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } 
    else {
        echo $response;
    }

?>