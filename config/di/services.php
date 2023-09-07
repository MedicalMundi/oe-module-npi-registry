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
