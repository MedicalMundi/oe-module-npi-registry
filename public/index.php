<?php declare(strict_types=1);

require_once __DIR__ . '/../src/Module.php';

use OpenEMR\Modules\NpiRegistry\Module;
use Twig\Environment;

if (Module::isStandAlone()) {
    require __DIR__ . '/../vendor/autoload.php';
} else {
    require __DIR__ . '/../../../../../vendor/autoload.php';
}

$module = Module::bootstrap();

$twig = $module->getContainer()->get(Environment::class);

echo $twig->render('index.html.twig', []);
