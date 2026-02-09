<?php

use Omisai\ViesSoap\DTO\CheckVatApproxResponse;

it('maps SOAP response to CheckVatApproxResponse', function () {
    $soapResponse = (object) [
        'countryCode' => 'FR',
        'vatNumber' => '987654321',
        'requestDate' => '2024-02-02',
        'valid' => false,
        'traderName' => 'Example SAS',
        'traderCompanyType' => 'FR-1',
        'traderAddress' => 'Paris',
        'traderStreet' => 'Rue de Test',
        'traderPostcode' => '75000',
        'traderCity' => 'Paris',
        'traderNameMatch' => '1',
        'traderCompanyTypeMatch' => '2',
        'traderStreetMatch' => '3',
        'traderPostcodeMatch' => '1',
        'traderCityMatch' => '2',
        'requestIdentifier' => 'REQ-1',
    ];

    $response = CheckVatApproxResponse::fromSoapResponse($soapResponse);

    expect($response->countryCode)->toBe('FR')
        ->and($response->vatNumber)->toBe('987654321')
        ->and($response->valid)->toBeFalse()
        ->and($response->traderName)->toBe('Example SAS')
        ->and($response->traderCompanyType)->toBe('FR-1')
        ->and($response->traderAddress)->toBe('Paris')
        ->and($response->traderStreet)->toBe('Rue de Test')
        ->and($response->traderPostcode)->toBe('75000')
        ->and($response->traderCity)->toBe('Paris')
        ->and($response->traderNameMatch)->toBe('1')
        ->and($response->traderCompanyTypeMatch)->toBe('2')
        ->and($response->traderStreetMatch)->toBe('3')
        ->and($response->traderPostcodeMatch)->toBe('1')
        ->and($response->traderCityMatch)->toBe('2')
        ->and($response->requestIdentifier)->toBe('REQ-1')
        ->and($response->requestDate->format('Y-m-d'))->toBe('2024-02-02');
});
