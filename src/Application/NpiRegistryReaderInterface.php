<?php declare(strict_types=1);

namespace OpenEMR\Modules\NpiRegistry\Application;

interface NpiRegistryReaderInterface
{
    public function search(array $searchParams): ?object;
}
