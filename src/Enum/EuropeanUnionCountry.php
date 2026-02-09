<?php

namespace Omisai\ViesSoap\Enum;

enum EuropeanUnionCountry: string
{
    case AT = 'Austria';
    case BE = 'Belgium';
    case BG = 'Bulgaria';
    case CZ = 'Czechia';
    case DK = 'Denmark';
    case DE = 'Germany';
    case EE = 'Estonia';
    case EL = 'Greece';
    case ES = 'Spain';
    case IE = 'Ireland';
    case FR = 'France';
    case HR = 'Croatia';
    case IT = 'Italy';
    case CY = 'Cyprus';
    case LV = 'Latvia';
    case LT = 'Lithuania';
    case LU = 'Luxembourg';
    case HU = 'Hungary';
    case MT = 'Malta';
    case NL = 'Netherlands';
    case PL = 'Poland';
    case PT = 'Portugal';
    case RO = 'Romania';
    case SI = 'Slovenia';
    case SK = 'Slovakia';
    case FI = 'Finland';
    case SE = 'Sweden';
    case XI = 'NorthernIreland';

    public static function isEUCountryCode(string $countryCode): bool
    {
        return self::isEuropeanUnionCountryCode($countryCode);
    }

    public static function isEuropeanUnionCountryCode(string $countryCode): bool
    {
        $countryCode = strtoupper($countryCode);

        foreach (self::cases() as $europeanUnionCountryCode) {
            if ($countryCode === $europeanUnionCountryCode->name) {
                return true;
            }
        }

        return false;
    }

    public static function isHungarianCountryCode(string $countryCode): bool
    {
        return strtoupper($countryCode) === self::HU->name;
    }

    public static function isAustriaCountryCode(string $countryCode): bool
    {
        return strtoupper($countryCode) === self::AT->name;
    }

    public static function isBelgiumCountryCode(string $countryCode): bool
    {
        return strtoupper($countryCode) === self::BE->name;
    }

    public static function isBulgariaCountryCode(string $countryCode): bool
    {
        return strtoupper($countryCode) === self::BG->name;
    }

    public static function isCzechiaCountryCode(string $countryCode): bool
    {
        return strtoupper($countryCode) === self::CZ->name;
    }

    public static function isDenmarkCountryCode(string $countryCode): bool
    {
        return strtoupper($countryCode) === self::DK->name;
    }

    public static function isGermanyCountryCode(string $countryCode): bool
    {
        return strtoupper($countryCode) === self::DE->name;
    }

    public static function isEstoniaCountryCode(string $countryCode): bool
    {
        return strtoupper($countryCode) === self::EE->name;
    }

    public static function isGreeceCountryCode(string $countryCode): bool
    {
        return strtoupper($countryCode) === self::EL->name;
    }

    public static function isSpainCountryCode(string $countryCode): bool
    {
        return strtoupper($countryCode) === self::ES->name;
    }

    public static function isIrelandCountryCode(string $countryCode): bool
    {
        return strtoupper($countryCode) === self::IE->name;
    }

    public static function isFranceCountryCode(string $countryCode): bool
    {
        return strtoupper($countryCode) === self::FR->name;
    }

    public static function isCroatiaCountryCode(string $countryCode): bool
    {
        return strtoupper($countryCode) === self::HR->name;
    }

    public static function isItalyCountryCode(string $countryCode): bool
    {
        return strtoupper($countryCode) === self::IT->name;
    }

    public static function isCyprusCountryCode(string $countryCode): bool
    {
        return strtoupper($countryCode) === self::CY->name;
    }

    public static function isLatviaCountryCode(string $countryCode): bool
    {
        return strtoupper($countryCode) === self::LV->name;
    }

    public static function isLithuaniaCountryCode(string $countryCode): bool
    {
        return strtoupper($countryCode) === self::LT->name;
    }

    public static function isLuxembourgCountryCode(string $countryCode): bool
    {
        return strtoupper($countryCode) === self::LU->name;
    }

    public static function isHungaryCountryCode(string $countryCode): bool
    {
        return strtoupper($countryCode) === self::HU->name;
    }

    public static function isMaltaCountryCode(string $countryCode): bool
    {
        return strtoupper($countryCode) === self::MT->name;
    }

    public static function isNetherlandsCountryCode(string $countryCode): bool
    {
        return strtoupper($countryCode) === self::NL->name;
    }

    public static function isPolandCountryCode(string $countryCode): bool
    {
        return strtoupper($countryCode) === self::PL->name;
    }

    public static function isPortugalCountryCode(string $countryCode): bool
    {
        return strtoupper($countryCode) === self::PT->name;
    }

    public static function isRomaniaCountryCode(string $countryCode): bool
    {
        return strtoupper($countryCode) === self::RO->name;
    }

    public static function isSloveniaCountryCode(string $countryCode): bool
    {
        return strtoupper($countryCode) === self::SI->name;
    }

    public static function isSlovakiaCountryCode(string $countryCode): bool
    {
        return strtoupper($countryCode) === self::SK->name;
    }

    public static function isFinlandCountryCode(string $countryCode): bool
    {
        return strtoupper($countryCode) === self::FI->name;
    }

    public static function isSwedenCountryCode(string $countryCode): bool
    {
        return strtoupper($countryCode) === self::SE->name;
    }

    public static function isNorthernIrelandCountryCode(string $countryCode): bool
    {
        return strtoupper($countryCode) === self::XI->name;
    }
}
