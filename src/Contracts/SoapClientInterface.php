<?php

namespace Omisai\ViesSoap\Contracts;

interface SoapClientInterface
{
    public function checkVat(array $params): object;

    public function checkVatApprox(array $params): object;
}
