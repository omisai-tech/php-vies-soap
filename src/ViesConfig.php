<?php

namespace Omisai\ViesSoap;

class ViesConfig
{
    public const PRODUCTION_WSDL = 'https://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl';

    public const TEST_WSDL = 'https://ec.europa.eu/taxation_customs/vies/checkVatTestService.wsdl';

    /** @param array<string, mixed> $options */
    public function __construct(
        private string $wsdl = self::PRODUCTION_WSDL,
        private array $options = [],
    ) {}

    public static function production(array $options = []): self
    {
        return new self(self::PRODUCTION_WSDL, $options);
    }

    public static function test(array $options = []): self
    {
        return new self(self::TEST_WSDL, $options);
    }

    public function getWsdl(): string
    {
        return $this->wsdl;
    }

    /** @return array<string, mixed> */
    public function getOptions(): array
    {
        return $this->options;
    }
}
