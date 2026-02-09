<?php

use Omisai\ViesSoap\Exceptions\ViesValidationException;
use Omisai\ViesSoap\Validation\VatNumberValidator;

it('validates country codes and VAT numbers', function () {
    $validator = new VatNumberValidator();

    [$countryCode, $vatNumber] = $validator->validate('de', '123456789');

    expect($countryCode)->toBe('DE')
        ->and($vatNumber)->toBe('123456789');
});

it('rejects invalid country codes', function () {
    $validator = new VatNumberValidator();

    $validator->validateCountryCode('D1');
})->throws(ViesValidationException::class);

it('rejects invalid VAT numbers', function () {
    $validator = new VatNumberValidator();

    $validator->validateVatNumber('!@#');
})->throws(ViesValidationException::class);
