<?php declare(strict_types=1);

/*
 * This file is part of the medicalmundi/oe-module-npi-registry
 *
 * @copyright (c) Zerai Teclai <teclaizerai@gmail.com>.
 * @copyright (c) Francesca Bonadonna <francescabonadonna@gmail.com>.
 *
 * This software consists of voluntary contributions made by many individuals
 * {@link https://github.com/medicalmundi/oe-module-npi-registry/graphs/contributors developer} and is licensed under the MIT license.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * @license https://github.com/MedicalMundi/oe-module-npi-registry/blob/main/LICENSE MIT
 */

namespace OpenEMR\Modules\NpiRegistry;

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

/**
 * @psalm-suppress MissingConstructor
 */
class Module
{
    public const MODULE_NAME = 'NPI Registry';

    public const MODULE_VERSION = 'v0.1.0';

    public const MODULE_SOURCE_CODE = 'https://github.com/MedicalMundi/oe-module-npi-registry';

    public const VENDOR_NAME = 'MedicalMundi';

    public const VENDOR_URL = 'https://github.com/medicalmundi';

    public const LICENSE = 'MIT';

    public const LICENSE_URL = 'https://github.com/MedicalMundi/oe-module-npi-registry/blob/main/LICENSE';

    private ContainerInterface $container;

    public static function bootstrap(): self
    {
        $module = new self();
        $module->container = $module->buildContainer();

        return $module;
    }

    private function buildContainer(): ContainerInterface
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->useAutowiring(true);
        $containerBuilder->addDefinitions(__DIR__ . '/../config/di/services.php');
        $containerBuilder->addDefinitions(__DIR__ . '/../config/di/twig.php');

        return $containerBuilder->build();
    }

    public static function isStandAlone(): bool
    {
        $interfaceRootDirectory = \dirname(__DIR__, 4);
        $openemrGlobalFile = $interfaceRootDirectory . DIRECTORY_SEPARATOR . "globals.php";
        return ! file_exists($openemrGlobalFile);
    }

    public static function mainDir(): string
    {
        return \dirname(__DIR__, 1);
    }

    public static function openemrDir(): string
    {
        return \dirname(__DIR__, 5);
    }

    public static function documentsDir(): string
    {
        if (Module::isStandAlone()) {
            return Module::mainDir() . '/var/Documents';
        }
        return Module::openemrDir() . '/Documentation';
    }

    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }
}
