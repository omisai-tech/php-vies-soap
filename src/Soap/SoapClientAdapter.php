<?php

namespace Omisai\ViesSoap\Soap;

use Omisai\ViesSoap\Contracts\SoapClientInterface;

class SoapClientAdapter implements SoapClientInterface
{
    private \SoapClient $client;

    /** @param array<string, mixed> $options */
    public function __construct(string $wsdl, array $options = [])
    {
        $this->client = new \SoapClient($wsdl, $options);
    }

    public function checkVat(array $params): object
    {
        return $this->client->__soapCall('checkVat', [$params]);
    }

    public function checkVatApprox(array $params): object
    {
        return $this->client->__soapCall('checkVatApprox', [$params]);
    }
}
