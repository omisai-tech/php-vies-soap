<?php

namespace Omisai\ViesSoap\DTO;

class CheckVatResponse
{
    public function __construct(
        public readonly string $countryCode,
        public readonly string $vatNumber,
        public readonly \DateTimeImmutable $requestDate,
        public readonly bool $valid,
        public readonly ?string $name,
        public readonly ?string $address,
    ) {}

    public static function fromSoapResponse(object $response): self
    {
        $requestDate = new \DateTimeImmutable((string) $response->requestDate);

        $name = null;
        if (property_exists($response, 'name')) {
            $name = $response->name !== null ? (string) $response->name : null;
        }

        $address = null;
        if (property_exists($response, 'address')) {
            $address = $response->address !== null ? (string) $response->address : null;
        }

        return new self(
            (string) $response->countryCode,
            (string) $response->vatNumber,
            $requestDate,
            (bool) $response->valid,
            $name,
            $address,
        );
    }
}
