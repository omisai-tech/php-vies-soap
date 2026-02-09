<?php

namespace Tests\Support;

use Omisai\ViesSoap\Contracts\SoapClientInterface;

class FakeSoapClient implements SoapClientInterface
{
    /** @var array<string, mixed> */
    public array $lastParams = [];

    public ?string $lastMethod = null;

    public function __construct(
        private ?object $response = null,
        private ?\Throwable $exception = null,
    ) {}

    public function checkVat(array $params): object
    {
        $this->lastMethod = 'checkVat';
        $this->lastParams = $params;

        if ($this->exception !== null) {
            throw $this->exception;
        }

        return $this->response ?? (object) [];
    }

    public function checkVatApprox(array $params): object
    {
        $this->lastMethod = 'checkVatApprox';
        $this->lastParams = $params;

        if ($this->exception !== null) {
            throw $this->exception;
        }

        return $this->response ?? (object) [];
    }
}
