<?php

use Omisai\ViesSoap\DTO\CheckVatResponse;

it('maps SOAP response to CheckVatResponse', function () {
    $soapResponse = (object) [
        'countryCode' => 'DE',
        'vatNumber' => '123456789',
        'requestDate' => '2024-01-15',
        'valid' => true,
        'name' => 'Acme GmbH',
        'address' => 'Berlin',
    ];

    $response = CheckVatResponse::fromSoapResponse($soapResponse);

    expect($response->countryCode)->toBe('DE')
        ->and($response->vatNumber)->toBe('123456789')
        ->and($response->valid)->toBeTrue()
        ->and($response->name)->toBe('Acme GmbH')
        ->and($response->address)->toBe('Berlin')
        ->and($response->requestDate->format('Y-m-d'))->toBe('2024-01-15');
});
