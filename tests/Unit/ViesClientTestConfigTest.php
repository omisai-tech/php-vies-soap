<?php

use Omisai\ViesSoap\ViesClient;
use Omisai\ViesSoap\ViesConfig;
use Tests\Support\FakeSoapClient;
use Tests\Support\RecordingSoapClientFactory;

it('uses test ViesConfig WSDL when calling ViesClient', function () {
    $soapResponse = (object) [
        'countryCode' => 'DE',
        'vatNumber' => '123456789',
        'requestDate' => '2024-05-05',
        'valid' => true,
        'name' => null,
        'address' => null,
    ];

    $fakeClient = new FakeSoapClient($soapResponse);
    $factory = new RecordingSoapClientFactory($fakeClient);

    $client = new ViesClient(ViesConfig::test(), $factory);

    $client->checkVat('DE', '123456789');

    expect($factory->lastWsdl)->toBe(ViesConfig::TEST_WSDL);
});
