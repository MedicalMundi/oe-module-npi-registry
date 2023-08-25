<?php declare(strict_types=1);

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
