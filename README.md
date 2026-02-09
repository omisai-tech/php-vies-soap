# PHP VIES SOAP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/omisai/vies-soap.svg?style=flat-square)](https://packagist.org/packages/omisai/vies-soap)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=flat-square)](https://github.com/sponsors/omisai-tech/LICENSE)
[![Tests](https://img.shields.io/github/actions/workflow/status/omisai-tech/php-vies-soap/test.yml?branch=main&style=flat-square)](https://github.com/omisai-tech/php-vies-soap/actions/workflows/test.yml)
[![PHP Version Require](https://img.shields.io/badge/PHP-%3E%3D8.1-blue?style=flat-square&logo=php)](https://packagist.org/packages/omisai//vies-soap)

A lightweight, type-safe PHP package for validating EU VAT numbers via the European Commission's VIES (VAT Information Exchange System) SOAP service.

## Features

- ✅ **Type-safe**: Full PHP 8.1+ type declarations and modern enum support
- ✅ **Comprehensive validation**: Built-in country code and VAT number validation
- ✅ **Production ready**: Supports both production and test VIES services
- ✅ **Error handling**: Structured exceptions for SOAP faults and validation errors
- ✅ **Approximate matching**: Advanced VAT validation with trader details
- ✅ **All EU countries**: Support for all 27 EU member states plus Northern Ireland
- ✅ **Tested**: 100% test coverage with Pest PHP testing framework

## Requirements

- PHP 8.1 or higher
- SOAP extension (`ext-soap`) enabled

## Installation

Install the package via Composer:

```bash
composer require omisai/vies-soap
```

## Quick Start

### Basic VAT Validation

```php
use Omisai\ViesSoap\ViesClient;

$client = new ViesClient();
$response = $client->checkVat('DE', '123456789');

if ($response->valid) {
    echo "✅ Valid VAT: {$response->countryCode}{$response->vatNumber}\n";
    echo "Company: {$response->name}\n";
    echo "Address: {$response->address}\n";
} else {
    echo "❌ Invalid VAT number\n";
}
```

### Using the Test Service

For development and testing, use the VIES test service:

```php
use Omisai\ViesSoap\ViesClient;
use Omisai\ViesSoap\ViesConfig;

$client = new ViesClient(ViesConfig::test());
$response = $client->checkVat('DE', '100'); // Test VAT number

var_dump($response->valid); // true for test numbers
```

## Configuration

### Environment Configuration

```php
use Omisai\ViesSoap\ViesConfig;

// Production environment (default)
$config = ViesConfig::production();

// Test environment
$config = ViesConfig::test();

// Custom WSDL URL
$config = new ViesConfig('https://custom-vies-service.com/service.wsdl');

// With SOAP options
$config = ViesConfig::production([
    'connection_timeout' => 30,
    'trace' => true,
    'cache_wsdl' => WSDL_CACHE_NONE,
]);
```

### SOAP Client Options

You can pass additional SOAP client options to customize the HTTP requests:

```php
use Omisai\ViesSoap\ViesClient;
use Omisai\ViesSoap\ViesConfig;

$options = [
    'connection_timeout' => 30,
    'trace' => true,
    'cache_wsdl' => WSDL_CACHE_BOTH,
    'user_agent' => 'MyApp/1.0',
    'proxy_host' => 'proxy.example.com',
    'proxy_port' => 8080,
];

$config = ViesConfig::production($options);
$client = new ViesClient($config);
```

## API Reference

### ViesClient

The main client class for interacting with VIES services.

#### Constructor

```php
public function __construct(
    ViesConfig $config = new ViesConfig(),
    ?SoapClientFactoryInterface $clientFactory = null,
    ?VatNumberValidator $validator = null,
)
```

#### Methods

##### `checkVat(string $countryCode, string $vatNumber): CheckVatResponse`

Validates a VAT number and returns basic information.

**Parameters:**
- `$countryCode`: Two-letter EU country code (e.g., 'DE', 'FR', 'NL')
- `$vatNumber`: The VAT number to validate

**Returns:** `CheckVatResponse` object

**Example:**
```php
$response = $client->checkVat('NL', '123456789B01');

echo "Country: {$response->countryCode}\n";
echo "VAT Number: {$response->vatNumber}\n";
echo "Valid: " . ($response->valid ? 'Yes' : 'No') . "\n";
echo "Request Date: {$response->requestDate->format('Y-m-d')}\n";
echo "Company Name: {$response->name}\n";
echo "Address: {$response->address}\n";
```

##### `checkVatApprox(CheckVatApproxRequest $request): CheckVatApproxResponse`

Performs approximate VAT validation with trader details for enhanced verification.

**Parameters:**
- `$request`: A `CheckVatApproxRequest` object with trader information

**Returns:** `CheckVatApproxResponse` object

**Example:**
```php
use Omisai\ViesSoap\DTO\CheckVatApproxRequest;

$request = new CheckVatApproxRequest(
    countryCode: 'NL',
    vatNumber: '123456789B01',
    traderName: 'Example B.V.',
    traderStreet: 'Main Street 123',
    traderPostcode: '1234AB',
    traderCity: 'Amsterdam',
    requesterCountryCode: 'DE', // Optional: Your own VAT country
    requesterVatNumber: '123456789', // Optional: Your own VAT number
);

$response = $client->checkVatApprox($request);

echo "Valid: " . ($response->valid ? 'Yes' : 'No') . "\n";
echo "Request ID: {$response->requestIdentifier}\n";
echo "Name Match: {$response->traderNameMatch}\n";
echo "Address Match: {$response->traderStreetMatch}\n";
```

### Data Transfer Objects (DTOs)

#### CheckVatResponse

Contains the response from a basic VAT check.

**Properties:**
- `countryCode`: string - The validated country code
- `vatNumber`: string - The validated VAT number
- `requestDate`: DateTimeImmutable - When the request was made
- `valid`: bool - Whether the VAT number is valid
- `name`: ?string - Company name (if available)
- `address`: ?string - Company address (if available)

#### CheckVatApproxResponse

Contains the response from an approximate VAT check with detailed matching information.

**Properties:**
- `countryCode`: string
- `vatNumber`: string
- `requestDate`: DateTimeImmutable
- `valid`: bool
- `traderName`: ?string
- `traderCompanyType`: ?string
- `traderAddress`: ?string
- `traderStreet`: ?string
- `traderPostcode`: ?string
- `traderCity`: ?string
- `traderNameMatch`: ?string - Match confidence for name
- `traderCompanyTypeMatch`: ?string - Match confidence for company type
- `traderStreetMatch`: ?string - Match confidence for street
- `traderPostcodeMatch`: ?string - Match confidence for postcode
- `traderCityMatch`: ?string - Match confidence for city
- `requestIdentifier`: string - Unique identifier for the request

#### CheckVatApproxRequest

Request object for approximate VAT validation.

**Constructor parameters:**
- `countryCode`: string (required)
- `vatNumber`: string (required)
- `traderName`: ?string
- `traderCompanyType`: ?string
- `traderStreet`: ?string
- `traderPostcode`: ?string
- `traderCity`: ?string
- `requesterCountryCode`: ?string - Your country's code for the request
- `requesterVatNumber`: ?string - Your VAT number for the request

## Supported Countries

The package supports all current EU member states plus Northern Ireland (XI):

| Code | Country | Code | Country | Code | Country |
|------|---------|------|---------|------|---------|
| AT | Austria | EL | Greece | MT | Malta |
| BE | Belgium | ES | Spain | NL | Netherlands |
| BG | Bulgaria | FI | Finland | PL | Poland |
| CY | Cyprus | FR | France | PT | Portugal |
| CZ | Czechia | HR | Croatia | RO | Romania |
| DE | Germany | HU | Hungary | SE | Sweden |
| DK | Denmark | IE | Ireland | SI | Slovenia |
| EE | Estonia | IT | Italy | SK | Slovakia |
|      |         | LV | Latvia | XI | Northern Ireland |
|      |         | LT | Lithuania |     |         |
|      |         | LU | Luxembourg |     |         |

### Country Code Validation

```php
use Omisai\ViesSoap\Enum\EuropeanUnionCountry;

// Check if a country code is valid
$isValid = EuropeanUnionCountry::isEuropeanUnionCountryCode('DE'); // true
$isValid = EuropeanUnionCountry::isEuropeanUnionCountryCode('US'); // false

// Get all supported countries
$countries = EuropeanUnionCountry::cases();
foreach ($countries as $country) {
    echo "{$country->name}: {$country->value}\n";
}
```

## Error Handling

The package provides structured exception handling for different error scenarios.

### Validation Errors

```php
use Omisai\ViesSoap\Exceptions\ViesValidationException;
use Omisai\ViesSoap\ViesClient;

$client = new ViesClient();

try {
    $response = $client->checkVat('INVALID', '123');
} catch (ViesValidationException $e) {
    echo "Validation error: {$e->getMessage()}\n";
    // Handle invalid country code or VAT number format
}
```

### SOAP Service Errors

```php
use Omisai\ViesSoap\Exceptions\ViesSoapException;
use Omisai\ViesSoap\ViesClient;

$client = new ViesClient();

try {
    $response = $client->checkVat('DE', '123456789');
} catch (ViesSoapException $e) {
    echo "SOAP error: {$e->getMessage()}\n";
    echo "Fault code: {$e->getFaultCode()}\n";
    echo "Fault string: {$e->getFaultString()}\n";
    // Handle service unavailability, invalid requests, etc.
}
```

### Common Exception Types

- **`ViesValidationException`**: Invalid country code or VAT number format
- **`ViesSoapException`**: SOAP service errors (service unavailable, invalid requests, etc.)

## Advanced Usage

### Custom SOAP Client

You can inject custom SOAP client implementations for testing or advanced scenarios:

```php
use Omisai\ViesSoap\ViesClient;
use Omisai\ViesSoap\Soap\SoapClientFactoryInterface;

class CustomSoapClientFactory implements SoapClientFactoryInterface
{
    // Implement your custom factory
}

$client = new ViesClient(
    clientFactory: new CustomSoapClientFactory()
);
```

### Custom Validation

```php
use Omisai\ViesSoap\ViesClient;
use Omisai\ViesSoap\Validation\VatNumberValidator;

class CustomVatNumberValidator extends VatNumberValidator
{
    // Implement custom validation logic
}

$client = new ViesClient(
    validator: new CustomVatNumberValidator()
);
```

### Batch Processing

```php
use Omisai\ViesSoap\ViesClient;

$client = new ViesClient();
$vatNumbers = [
    ['DE', '123456789'],
    ['NL', '123456789B01'],
    ['FR', '12345678901'],
];

$results = [];
foreach ($vatNumbers as [$country, $vat]) {
    try {
        $response = $client->checkVat($country, $vat);
        $results[] = [
            'country' => $response->countryCode,
            'vat' => $response->vatNumber,
            'valid' => $response->valid,
            'name' => $response->name,
        ];
    } catch (Exception $e) {
        $results[] = [
            'country' => $country,
            'vat' => $vat,
            'error' => $e->getMessage(),
        ];
    }
}

print_r($results);
```

## Testing

Run the test suite using Pest:

```bash
composer test
```

### Testing with Mock Data

The package includes test helpers for mocking SOAP responses:

```php
use Omisai\ViesSoap\ViesClient;
use Tests\Support\FakeSoapClient;
use Tests\Support\FakeSoapClientFactory;

// Create a fake SOAP response
$soapResponse = (object) [
    'countryCode' => 'DE',
    'vatNumber' => '123456789',
    'requestDate' => '2024-01-01',
    'valid' => true,
    'name' => 'Test Company GmbH',
    'address' => 'Test Street 123, 12345 Test City',
];

$fakeClient = new FakeSoapClient($soapResponse);
$client = new ViesClient(
    clientFactory: new FakeSoapClientFactory($fakeClient)
);

$response = $client->checkVat('DE', '123456789');
// Response will contain the fake data
```

## Performance Considerations

- The VIES service has rate limits - avoid excessive requests
- SOAP calls are synchronous and may take 1-5 seconds
- Consider caching valid VAT numbers to reduce API calls
- Use the test service for development to avoid affecting production quotas

## Limitations

- Requires internet connection to VIES service
- SOAP extension must be enabled in PHP
- Service may be unavailable during maintenance windows
- Rate limiting applies to prevent abuse
- Some countries may have additional validation rules

## Contributing

Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details on how to contribute to this project.

## Security

If you discover any security-related issues, please email security@omisai.com instead of using the issue tracker.

## License

This package is open-sourced software licensed under the [MIT license](https://github.com/sponsors/omisai-tech/LICENSE).

## Sponsoring

If you find this package useful, please consider sponsoring the development: [Sponsoring on GitHub](https://github.com/sponsors/omisai-tech)

Your support helps us maintain and improve this open-source project!

## Official VIES Documentation

- [European Commission VIES Website](https://ec.europa.eu/taxation_customs/vies)
- [VIES SOAP API Documentation](https://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl)
- [VIES Test Service](https://ec.europa.eu/taxation_customs/vies/checkVatTestService.wsdl)
