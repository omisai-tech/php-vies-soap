<?php

use Omisai\ViesSoap\DTO\CheckVatApproxRequest;
use Omisai\ViesSoap\DTO\CheckVatResponse;
use Omisai\ViesSoap\Exceptions\ViesSoapException;
use Omisai\ViesSoap\ViesClient;
use Tests\Support\FakeSoapClient;
use Tests\Support\FakeSoapClientFactory;

it('checks VAT numbers and normalizes country code', function () {
    $soapResponse = (object) [
        'countryCode' => 'DE',
        'vatNumber' => '123456789',
        'requestDate' => '2024-03-03',
        'valid' => true,
        'name' => null,
        'address' => null,
    ];

    $fakeClient = new FakeSoapClient($soapResponse);
    $client = new ViesClient(clientFactory: new FakeSoapClientFactory($fakeClient));

    $response = $client->checkVat('de', '123456789');

    expect($response)->toBeInstanceOf(CheckVatResponse::class)
        ->and($fakeClient->lastMethod)->toBe('checkVat')
        ->and($fakeClient->lastParams['countryCode'])->toBe('DE')
        ->and($fakeClient->lastParams['vatNumber'])->toBe('123456789');
});

it('throws ViesSoapException on soap faults', function () {
    if (!class_exists(SoapFault::class)) {
        $this->markTestSkipped('ext-soap is not available.');
    }

    $fakeClient = new FakeSoapClient(null, new SoapFault('SERVER', 'SERVICE_UNAVAILABLE'));
    $client = new ViesClient(clientFactory: new FakeSoapClientFactory($fakeClient));

    $client->checkVat('DE', '123456789');
})->throws(ViesSoapException::class);

it('checks VAT numbers with approximate data', function () {
    $soapResponse = (object) [
        'countryCode' => 'NL',
        'vatNumber' => '123456789',
        'requestDate' => '2024-04-04',
        'valid' => true,
        'traderName' => 'Example BV',
        'traderCompanyType' => 'NL-1',
        'traderAddress' => 'Amsterdam',
        'traderStreet' => 'Teststraat 1',
        'traderPostcode' => '1000AA',
        'traderCity' => 'Amsterdam',
        'traderNameMatch' => '1',
        'traderCompanyTypeMatch' => '1',
        'traderStreetMatch' => '1',
        'traderPostcodeMatch' => '1',
        'traderCityMatch' => '1',
        'requestIdentifier' => 'REQ-2',
    ];

    $fakeClient = new FakeSoapClient($soapResponse);
    $client = new ViesClient(clientFactory: new FakeSoapClientFactory($fakeClient));

    $request = new CheckVatApproxRequest(
        countryCode: 'nl',
        vatNumber: '123456789',
        traderName: 'Example BV',
        requesterCountryCode: 'NL',
        requesterVatNumber: '123456789'
    );

    $client->checkVatApprox($request);

    expect($fakeClient->lastMethod)->toBe('checkVatApprox')
        ->and($fakeClient->lastParams['countryCode'])->toBe('NL')
        ->and($fakeClient->lastParams['vatNumber'])->toBe('123456789')
        ->and($fakeClient->lastParams['requesterCountryCode'])->toBe('NL')
        ->and($fakeClient->lastParams['requesterVatNumber'])->toBe('123456789');
});
