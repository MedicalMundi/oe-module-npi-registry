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

namespace OpenEMR\Modules\NpiRegistry\Tests\Unit\Module;

use OpenEMR\Modules\NpiRegistry\Module;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

/**
 * @covers \OpenEMR\Modules\NpiRegistry\Module
 */
class ModuleTest extends TestCase
{
    public function testModuleHasName(): void
    {
        self::assertIsString(Module::MODULE_VERSION);
        self::assertNotNull(Module::MODULE_VERSION);
        self::assertNotEmpty(Module::MODULE_VERSION);
        self::assertSame('NPI Registry', Module::MODULE_NAME);
    }

    public function testModuleHasVersion(): void
    {
        self::assertIsString(Module::MODULE_VERSION);
        self::assertNotNull(Module::MODULE_VERSION);
        self::assertNotEmpty(Module::MODULE_VERSION);
    }

    public function testModuleHasSourceCodeLink(): void
    {
        self::assertIsString(Module::MODULE_SOURCE_CODE);
        self::assertNotNull(Module::MODULE_SOURCE_CODE);
        self::assertNotEmpty(Module::MODULE_SOURCE_CODE);
        self::assertSame('https://github.com/MedicalMundi/oe-module-npi-registry', Module::MODULE_SOURCE_CODE);
    }

    public function testModuleHasVendorName(): void
    {
        self::assertIsString(Module::VENDOR_NAME);
        self::assertNotNull(Module::VENDOR_NAME);
        self::assertNotEmpty(Module::VENDOR_NAME);
        self::assertSame('MedicalMundi', Module::VENDOR_NAME);
    }

    public function testModuleHasVendorUrl(): void
    {
        self::assertIsString(Module::VENDOR_URL);
        self::assertNotNull(Module::VENDOR_URL);
        self::assertNotEmpty(Module::VENDOR_URL);
        self::assertSame('https://github.com/medicalmundi', Module::VENDOR_URL);
    }

    public function testModuleCanBeInstantiatedAsRegularMode(): void
    {
        self::assertInstanceOf(Module::class, Module::bootstrap());
    }

    public function testModuleHasADependencyInjectionContainer(): void
    {
        self::assertInstanceOf(ContainerInterface::class, Module::bootstrap()->getContainer());
    }

    public function testModuleExposeOwnDirectory(): void
    {
        self::assertNotEmpty(Module::mainDir());
        self::assertSame(\dirname(__DIR__, 3), Module::mainDir());
    }
}
