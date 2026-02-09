<?php

use Omisai\ViesSoap\Enum\EuropeanUnionCountry;

it('detects EU country codes', function () {
    expect(EuropeanUnionCountry::isEuropeanUnionCountryCode('de'))->toBeTrue()
        ->and(EuropeanUnionCountry::isEuropeanUnionCountryCode('us'))->toBeFalse();
});

it('detects Hungarian country code', function () {
    expect(EuropeanUnionCountry::isHungarianCountryCode('hu'))->toBeTrue()
        ->and(EuropeanUnionCountry::isHungarianCountryCode('de'))->toBeFalse();
});


it('detects Austria country code', function () {
    expect(EuropeanUnionCountry::isAustriaCountryCode('at'))->toBeTrue()
        ->and(EuropeanUnionCountry::isAustriaCountryCode('de'))->toBeFalse();
});

it('detects Belgium country code', function () {
    expect(EuropeanUnionCountry::isBelgiumCountryCode('be'))->toBeTrue()
        ->and(EuropeanUnionCountry::isBelgiumCountryCode('fr'))->toBeFalse();
});

it('detects Bulgaria country code', function () {
    expect(EuropeanUnionCountry::isBulgariaCountryCode('bg'))->toBeTrue()
        ->and(EuropeanUnionCountry::isBulgariaCountryCode('ro'))->toBeFalse();
});

it('detects Czechia country code', function () {
    expect(EuropeanUnionCountry::isCzechiaCountryCode('cz'))->toBeTrue()
        ->and(EuropeanUnionCountry::isCzechiaCountryCode('sk'))->toBeFalse();
});

it('detects Denmark country code', function () {
    expect(EuropeanUnionCountry::isDenmarkCountryCode('dk'))->toBeTrue()
        ->and(EuropeanUnionCountry::isDenmarkCountryCode('se'))->toBeFalse();
});

it('detects Germany country code', function () {
    expect(EuropeanUnionCountry::isGermanyCountryCode('de'))->toBeTrue()
        ->and(EuropeanUnionCountry::isGermanyCountryCode('at'))->toBeFalse();
});

it('detects Estonia country code', function () {
    expect(EuropeanUnionCountry::isEstoniaCountryCode('ee'))->toBeTrue()
        ->and(EuropeanUnionCountry::isEstoniaCountryCode('lv'))->toBeFalse();
});

it('detects Greece country code', function () {
    expect(EuropeanUnionCountry::isGreeceCountryCode('el'))->toBeTrue()
        ->and(EuropeanUnionCountry::isGreeceCountryCode('cy'))->toBeFalse();
});

it('detects Spain country code', function () {
    expect(EuropeanUnionCountry::isSpainCountryCode('es'))->toBeTrue()
        ->and(EuropeanUnionCountry::isSpainCountryCode('pt'))->toBeFalse();
});

it('detects Ireland country code', function () {
    expect(EuropeanUnionCountry::isIrelandCountryCode('ie'))->toBeTrue()
        ->and(EuropeanUnionCountry::isIrelandCountryCode('uk'))->toBeFalse();
});

it('detects France country code', function () {
    expect(EuropeanUnionCountry::isFranceCountryCode('fr'))->toBeTrue()
        ->and(EuropeanUnionCountry::isFranceCountryCode('be'))->toBeFalse();
});

it('detects Croatia country code', function () {
    expect(EuropeanUnionCountry::isCroatiaCountryCode('hr'))->toBeTrue()
        ->and(EuropeanUnionCountry::isCroatiaCountryCode('si'))->toBeFalse();
});

it('detects Italy country code', function () {
    expect(EuropeanUnionCountry::isItalyCountryCode('it'))->toBeTrue()
        ->and(EuropeanUnionCountry::isItalyCountryCode('fr'))->toBeFalse();
});

it('detects Cyprus country code', function () {
    expect(EuropeanUnionCountry::isCyprusCountryCode('cy'))->toBeTrue()
        ->and(EuropeanUnionCountry::isCyprusCountryCode('gr'))->toBeFalse();
});

it('detects Latvia country code', function () {
    expect(EuropeanUnionCountry::isLatviaCountryCode('lv'))->toBeTrue()
        ->and(EuropeanUnionCountry::isLatviaCountryCode('ee'))->toBeFalse();
});

it('detects Lithuania country code', function () {
    expect(EuropeanUnionCountry::isLithuaniaCountryCode('lt'))->toBeTrue()
        ->and(EuropeanUnionCountry::isLithuaniaCountryCode('lv'))->toBeFalse();
});

it('detects Luxembourg country code', function () {
    expect(EuropeanUnionCountry::isLuxembourgCountryCode('lu'))->toBeTrue()
        ->and(EuropeanUnionCountry::isLuxembourgCountryCode('fr'))->toBeFalse();
});

it('detects Hungary country code', function () {
    expect(EuropeanUnionCountry::isHungaryCountryCode('hu'))->toBeTrue()
        ->and(EuropeanUnionCountry::isHungaryCountryCode('at'))->toBeFalse();
});

it('detects Malta country code', function () {
    expect(EuropeanUnionCountry::isMaltaCountryCode('mt'))->toBeTrue()
        ->and(EuropeanUnionCountry::isMaltaCountryCode('it'))->toBeFalse();
});

it('detects Netherlands country code', function () {
    expect(EuropeanUnionCountry::isNetherlandsCountryCode('nl'))->toBeTrue()
        ->and(EuropeanUnionCountry::isNetherlandsCountryCode('be'))->toBeFalse();
});

it('detects Poland country code', function () {
    expect(EuropeanUnionCountry::isPolandCountryCode('pl'))->toBeTrue()
        ->and(EuropeanUnionCountry::isPolandCountryCode('de'))->toBeFalse();
});

it('detects Portugal country code', function () {
    expect(EuropeanUnionCountry::isPortugalCountryCode('pt'))->toBeTrue()
        ->and(EuropeanUnionCountry::isPortugalCountryCode('es'))->toBeFalse();
});

it('detects Romania country code', function () {
    expect(EuropeanUnionCountry::isRomaniaCountryCode('ro'))->toBeTrue()
        ->and(EuropeanUnionCountry::isRomaniaCountryCode('bg'))->toBeFalse();
});

it('detects Slovenia country code', function () {
    expect(EuropeanUnionCountry::isSloveniaCountryCode('si'))->toBeTrue()
        ->and(EuropeanUnionCountry::isSloveniaCountryCode('hr'))->toBeFalse();
});

it('detects Slovakia country code', function () {
    expect(EuropeanUnionCountry::isSlovakiaCountryCode('sk'))->toBeTrue()
        ->and(EuropeanUnionCountry::isSlovakiaCountryCode('cz'))->toBeFalse();
});

it('detects Finland country code', function () {
    expect(EuropeanUnionCountry::isFinlandCountryCode('fi'))->toBeTrue()
        ->and(EuropeanUnionCountry::isFinlandCountryCode('se'))->toBeFalse();
});

it('detects Sweden country code', function () {
    expect(EuropeanUnionCountry::isSwedenCountryCode('se'))->toBeTrue()
        ->and(EuropeanUnionCountry::isSwedenCountryCode('no'))->toBeFalse();
});

it('detects Northern Ireland country code', function () {
    expect(EuropeanUnionCountry::isNorthernIrelandCountryCode('xi'))->toBeTrue()
        ->and(EuropeanUnionCountry::isNorthernIrelandCountryCode('ie'))->toBeFalse();
});
