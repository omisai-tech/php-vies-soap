<?php

namespace Omisai\ViesSoap\Exceptions;

class ViesSoapException extends ViesException
{
    private ?string $faultCode;

    private ?string $faultString;

    public function __construct(string $message, ?string $faultCode = null, ?string $faultString = null, int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->faultCode = $faultCode;
        $this->faultString = $faultString;
    }

    public static function fromSoapFault(\SoapFault $fault): self
    {
        $message = $fault->getMessage();
        $faultCode = isset($fault->faultcode) ? (string) $fault->faultcode : null;
        $faultString = isset($fault->faultstring) ? (string) $fault->faultstring : null;

        return new self($message, $faultCode, $faultString, 0, $fault);
    }

    public function getFaultCode(): ?string
    {
        return $this->faultCode;
    }

    public function getFaultString(): ?string
    {
        return $this->faultString;
    }
}
