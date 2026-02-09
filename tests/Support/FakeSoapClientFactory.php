<?php

namespace Tests\Support;

use Omisai\ViesSoap\Contracts\SoapClientInterface;
use Omisai\ViesSoap\Soap\SoapClientFactoryInterface;

class FakeSoapClientFactory implements SoapClientFactoryInterface
{
    public function __construct(private SoapClientInterface $client) {}

    public function create(string $wsdl, array $options = []): SoapClientInterface
    {
        return $this->client;
    }
}
