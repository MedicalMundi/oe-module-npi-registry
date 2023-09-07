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

require_once __DIR__ . '/../src/Module.php';

use OpenEMR\Modules\NpiRegistry\Adapter\Http\Web\DefaultController;
use OpenEMR\Modules\NpiRegistry\Module;
use Symfony\Component\HttpFoundation\Request;

if (Module::isStandAlone()) {
    require __DIR__ . '/../vendor/autoload.php';
} else {
    require __DIR__ . '/../../../../../vendor/autoload.php';
}

$module = Module::bootstrap();

/**
 * TODO: use HTTP request/response
 */
$request = Request::createFromGlobals();

/** @var DefaultController $defaultController */
$defaultController = $module->getContainer()->get(DefaultController::class);

echo $defaultController($request);
