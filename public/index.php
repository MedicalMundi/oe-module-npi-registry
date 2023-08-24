<?php declare(strict_types=1);

require_once __DIR__ . '/../src/Module.php';

use MedicalMundi\NpiRegistry\SDK\NpiRegistry;
use OpenEMR\Modules\NpiRegistry\Module;

if (Module::isStandAlone()) {
    require __DIR__ . '/../vendor/autoload.php';
} else {
    require __DIR__ . '/../../../../../vendor/autoload.php';
}



$npiRegistry = NpiRegistry::connect();

$data = $npiRegistry->search
    ->where('version', '2.1') // api version is mandatory
    ->where('city', 'atlanta')
    ->fetch();

var_dump($data);
