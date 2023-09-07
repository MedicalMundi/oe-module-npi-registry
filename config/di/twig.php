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

use OpenEMR\Modules\NpiRegistry\Module;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(Module::mainDir() . DIRECTORY_SEPARATOR . "src/Adapter/Http/Web/Templates");

$twigOptions = [];

$TwigEnvironment = new Environment($loader, $twigOptions);

$TwigEnvironment->addGlobal('module', [
    'name' => Module::MODULE_NAME,
    'version' => Module::MODULE_VERSION,
    'source_code' => Module::MODULE_SOURCE_CODE,
    'vendor_name' => Module::VENDOR_NAME,
    'vendor_url' => Module::VENDOR_URL,
    'license' => Module::LICENSE,
    'license_url' => Module::LICENSE_URL,
    'isStandAlone' => Module::isStandAlone(),
]);

return [
    Environment::class => $TwigEnvironment,
];
