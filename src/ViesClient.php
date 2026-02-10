<?php

namespace Omisai\ViesSoap;

use Omisai\ViesSoap\DTO\CheckVatApproxRequest;
use Omisai\ViesSoap\DTO\CheckVatApproxResponse;
use Omisai\ViesSoap\DTO\CheckVatResponse;
use Omisai\ViesSoap\Exceptions\ViesSoapException;
use Omisai\ViesSoap\Soap\SoapClientFactory;
use Omisai\ViesSoap\Soap\SoapClientFactoryInterface;
use Omisai\ViesSoap\Validation\VatNumberValidator;

class ViesClient
{
    private SoapClientFactoryInterface $clientFactory;

    private VatNumberValidator $validator;

    public function __construct(
        private ViesConfig $config = new ViesConfig,
        ?SoapClientFactoryInterface $clientFactory = null,
        ?VatNumberValidator $validator = null,
    ) {
        $this->clientFactory = $clientFactory ?? new SoapClientFactory;
        $this->validator = $validator ?? new VatNumberValidator;
    }

    public function checkVat(string $countryCode, string $vatNumber): CheckVatResponse
    {
        [$countryCode, $vatNumber] = $this->validator->validate($countryCode, $vatNumber);

        $params = [
            'countryCode' => $countryCode,
            'vatNumber' => $vatNumber,
        ];

        try {
            $client = $this->clientFactory->create($this->config->getWsdl(), $this->buildOptions());
            $response = $client->checkVat($params);
        } catch (\SoapFault $fault) {
            throw ViesSoapException::fromSoapFault($fault);
        }

        return CheckVatResponse::fromSoapResponse($response);
    }

    public function checkVatApprox(CheckVatApproxRequest $request): CheckVatApproxResponse
    {
        $params = $request->toArray();

        $params['countryCode'] = $this->validator->validateCountryCode($params['countryCode']);
        $params['vatNumber'] = $this->validator->validateVatNumber($params['vatNumber']);

        if (array_key_exists('requesterCountryCode', $params)) {
            $params['requesterCountryCode'] = $this->validator->validateCountryCode($params['requesterCountryCode']);
        }

        if (array_key_exists('requesterVatNumber', $params)) {
            $params['requesterVatNumber'] = $this->validator->validateVatNumber($params['requesterVatNumber']);
        }

        try {
            $client = $this->clientFactory->create($this->config->getWsdl(), $this->buildOptions());
            $response = $client->checkVatApprox($params);
        } catch (\SoapFault $fault) {
            throw ViesSoapException::fromSoapFault($fault);
        }

        return CheckVatApproxResponse::fromSoapResponse($response);
    }

    /** @return array<string, mixed> */
    private function buildOptions(): array
    {
        $defaults = [
            'exceptions' => true,
            'trace' => false,
            'cache_wsdl' => defined('WSDL_CACHE_BOTH') ? WSDL_CACHE_BOTH : 0,
        ];

        return array_replace($defaults, $this->config->getOptions());
    }
}
