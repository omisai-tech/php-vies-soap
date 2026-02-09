<?php

use Omisai\ViesSoap\ViesConfig;

it('uses production and test WSDLs', function () {
    $production = ViesConfig::production();
    $test = ViesConfig::test();

    expect($production->getWsdl())->toBe(ViesConfig::PRODUCTION_WSDL)
        ->and($test->getWsdl())->toBe(ViesConfig::TEST_WSDL);
});
