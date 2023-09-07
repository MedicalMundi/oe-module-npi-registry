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

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
        __DIR__ . '/config/di',
    ]);

    // register a single rule
    $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);

    // define sets of rules
    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_73,
    ]);
};
