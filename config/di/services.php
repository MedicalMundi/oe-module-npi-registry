<?php declare(strict_types=1);

use MedicalMundi\NpiRegistry\SDK\NpiRegistry;
use OpenEMR\Modules\NpiRegistry\Adapter\NpiRegistry\NpiRegistryReader;
use OpenEMR\Modules\NpiRegistry\Application\NpiRegistryReaderInterface;
use Psr\Container\ContainerInterface;

return [
    NpiRegistry::class => DI\factory(function (ContainerInterface $c) {
        return NpiRegistry::connect();
    }),

    NpiRegistryReaderInterface::class => DI\get(NpiRegistryReader::class),
];
