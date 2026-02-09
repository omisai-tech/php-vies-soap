<?php

namespace Omisai\ViesSoap\Contracts;

interface SoapClientInterface
{
    /** @return object */
    public function checkVat(array $params): object;

    /** @return object */
    public function checkVatApprox(array $params): object;
}
