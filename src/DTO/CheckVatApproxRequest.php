<?php

namespace Omisai\ViesSoap\DTO;

class CheckVatApproxRequest
{
    public function __construct(
        public readonly string $countryCode,
        public readonly string $vatNumber,
        public readonly ?string $traderName = null,
        public readonly ?string $traderCompanyType = null,
        public readonly ?string $traderStreet = null,
        public readonly ?string $traderPostcode = null,
        public readonly ?string $traderCity = null,
        public readonly ?string $requesterCountryCode = null,
        public readonly ?string $requesterVatNumber = null,
    ) {}

    /** @return array<string, string> */
    public function toArray(): array
    {
        $payload = [
            'countryCode' => $this->countryCode,
            'vatNumber' => $this->vatNumber,
            'traderName' => $this->traderName,
            'traderCompanyType' => $this->traderCompanyType,
            'traderStreet' => $this->traderStreet,
            'traderPostcode' => $this->traderPostcode,
            'traderCity' => $this->traderCity,
            'requesterCountryCode' => $this->requesterCountryCode,
            'requesterVatNumber' => $this->requesterVatNumber,
        ];

        return array_filter(
            $payload,
            static fn (?string $value): bool => $value !== null
        );
    }
}
