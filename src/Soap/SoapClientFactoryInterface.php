<?php

namespace Omisai\ViesSoap\Soap;

use Omisai\ViesSoap\Contracts\SoapClientInterface;

interface SoapClientFactoryInterface
{
    /** @param array<string, mixed> $options */
    public function create(string $wsdl, array $options = []): SoapClientInterface;
}
