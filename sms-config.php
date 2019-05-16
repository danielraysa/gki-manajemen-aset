<?php

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

?>