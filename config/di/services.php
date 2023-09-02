<?php declare(strict_types=1);

use MedicalMundi\NpiRegistry\SDK\NpiRegistry;
use OpenEMR\Modules\NpiRegistry\Adapter\NpiRegistry\NpiRegistryRepository;
use OpenEMR\Modules\NpiRegistry\Application\NpiRegistryRepositoryInterface;
use Psr\Container\ContainerInterface;

return [
    NpiRegistry::class => DI\factory(function (ContainerInterface $c) {
        return NpiRegistry::connect();
    }),

    NpiRegistryRepositoryInterface::class => DI\get(NpiRegistryRepository::class),
];
