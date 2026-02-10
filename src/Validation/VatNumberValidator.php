<?php

namespace Omisai\ViesSoap\Validation;

use Omisai\ViesSoap\Exceptions\ViesValidationException;

class VatNumberValidator
{
    private const COUNTRY_CODE_PATTERN = '/^[A-Z]{2}$/';

    private const VAT_NUMBER_PATTERN = '/^[0-9A-Za-z+\*\.]{2,12}$/';

    /**
     * @return array{0: string, 1: string}
     */
    public function validate(string $countryCode, string $vatNumber): array
    {
        return [
            $this->validateCountryCode($countryCode),
            $this->validateVatNumber($vatNumber),
        ];
    }

    public function validateCountryCode(string $countryCode): string
    {
        $countryCode = strtoupper(trim($countryCode));

        if (!preg_match(self::COUNTRY_CODE_PATTERN, $countryCode)) {
            throw new ViesValidationException('Invalid country code.');
        }

        return $countryCode;
    }

    public function validateVatNumber(string $vatNumber): string
    {
        $vatNumber = trim($vatNumber);

        if (!preg_match(self::VAT_NUMBER_PATTERN, $vatNumber)) {
            throw new ViesValidationException('Invalid VAT number.');
        }

        return $vatNumber;
    }
}
