<?php

namespace Omisai\ViesSoap\DTO;

class CheckVatApproxResponse
{
    public function __construct(
        public readonly string $countryCode,
        public readonly string $vatNumber,
        public readonly \DateTimeImmutable $requestDate,
        public readonly bool $valid,
        public readonly ?string $traderName,
        public readonly ?string $traderCompanyType,
        public readonly ?string $traderAddress,
        public readonly ?string $traderStreet,
        public readonly ?string $traderPostcode,
        public readonly ?string $traderCity,
        public readonly ?string $traderNameMatch,
        public readonly ?string $traderCompanyTypeMatch,
        public readonly ?string $traderStreetMatch,
        public readonly ?string $traderPostcodeMatch,
        public readonly ?string $traderCityMatch,
        public readonly string $requestIdentifier,
    ) {}

    public static function fromSoapResponse(object $response): self
    {
        $requestDate = new \DateTimeImmutable((string) $response->requestDate);

        $traderName = property_exists($response, 'traderName')
            ? ($response->traderName !== null ? (string) $response->traderName : null)
            : null;
        $traderCompanyType = property_exists($response, 'traderCompanyType')
            ? ($response->traderCompanyType !== null ? (string) $response->traderCompanyType : null)
            : null;
        $traderAddress = property_exists($response, 'traderAddress')
            ? ($response->traderAddress !== null ? (string) $response->traderAddress : null)
            : null;
        $traderStreet = property_exists($response, 'traderStreet')
            ? ($response->traderStreet !== null ? (string) $response->traderStreet : null)
            : null;
        $traderPostcode = property_exists($response, 'traderPostcode')
            ? ($response->traderPostcode !== null ? (string) $response->traderPostcode : null)
            : null;
        $traderCity = property_exists($response, 'traderCity')
            ? ($response->traderCity !== null ? (string) $response->traderCity : null)
            : null;
        $traderNameMatch = property_exists($response, 'traderNameMatch')
            ? ($response->traderNameMatch !== null ? (string) $response->traderNameMatch : null)
            : null;
        $traderCompanyTypeMatch = property_exists($response, 'traderCompanyTypeMatch')
            ? ($response->traderCompanyTypeMatch !== null ? (string) $response->traderCompanyTypeMatch : null)
            : null;
        $traderStreetMatch = property_exists($response, 'traderStreetMatch')
            ? ($response->traderStreetMatch !== null ? (string) $response->traderStreetMatch : null)
            : null;
        $traderPostcodeMatch = property_exists($response, 'traderPostcodeMatch')
            ? ($response->traderPostcodeMatch !== null ? (string) $response->traderPostcodeMatch : null)
            : null;
        $traderCityMatch = property_exists($response, 'traderCityMatch')
            ? ($response->traderCityMatch !== null ? (string) $response->traderCityMatch : null)
            : null;

        return new self(
            (string) $response->countryCode,
            (string) $response->vatNumber,
            $requestDate,
            (bool) $response->valid,
            $traderName,
            $traderCompanyType,
            $traderAddress,
            $traderStreet,
            $traderPostcode,
            $traderCity,
            $traderNameMatch,
            $traderCompanyTypeMatch,
            $traderStreetMatch,
            $traderPostcodeMatch,
            $traderCityMatch,
            (string) $response->requestIdentifier,
        );
    }
}
