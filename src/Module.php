<?php declare(strict_types=1);

namespace OpenEMR\Modules\NpiRegistry;

class Module
{
    public const MODULE_NAME = 'Npi Registry';

    public const MODULE_VERSION = 'v0.0.0';

    public const MODULE_SOURCE_CODE = 'https://github.com/MedicalMundi/npi-registry-sdk';

    public const VENDOR_NAME = 'MedicalMundi';

    public const VENDOR_URL = 'https://github.com/medicalmundi';

    public static function bootstrap(): self
    {
        return new self();
    }

    public static function isStandAlone(): bool
    {
        $interfaceRootDirectory = \dirname(__DIR__, 4);
        $openemrGlobalFile = $interfaceRootDirectory . DIRECTORY_SEPARATOR . "globals.php";
        return ! file_exists($openemrGlobalFile);
    }

    public static function mainDir(): string
    {
        return \dirname(__DIR__, 5);
    }

    public static function openemrDir(): string
    {
        return \dirname(__DIR__, 1);
    }

    public static function documentsDir(): string
    {
        if (Module::isStandAlone()) {
            return Module::mainDir() . '/var/Documents';
        }
        return Module::openemrDir() . '/Documentation';
    }
}