<?php

namespace Tests\Support;

use Omisai\ViesSoap\Contracts\SoapClientInterface;
use Omisai\ViesSoap\Soap\SoapClientFactoryInterface;

class RecordingSoapClientFactory implements SoapClientFactoryInterface
{
    public ?string $lastWsdl = null;

    /** @var array<string, mixed>|null */
    public ?array $lastOptions = null;

    public function __construct(private SoapClientInterface $client) {}

    public function create(string $wsdl, array $options = []): SoapClientInterface
    {
        $this->lastWsdl = $wsdl;
        $this->lastOptions = $options;

        return $this->client;
    }
}
