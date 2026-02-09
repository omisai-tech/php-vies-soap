<?php

namespace Omisai\ViesSoap\Soap;

use Omisai\ViesSoap\Contracts\SoapClientInterface;

class SoapClientFactory implements SoapClientFactoryInterface
{
    public function create(string $wsdl, array $options = []): SoapClientInterface
    {
        return new SoapClientAdapter($wsdl, $options);
    }
}
