<?php declare(strict_types=1);

namespace OpenEMR\Modules\NpiRegistry\Adapter\NpiRegistry;

use MedicalMundi\NpiRegistry\SDK\NpiRegistry;
use OpenEMR\Modules\NpiRegistry\Application\NpiRegistryRepositoryInterface;

class NpiRegistryRepository implements NpiRegistryRepositoryInterface
{
    private const DEFAULT_API_VERSION = '2.1';

    private NpiRegistry $npiRegistry;

    public function __construct(NpiRegistry $npiRegistry)
    {
        $this->npiRegistry = $npiRegistry;
    }

    public function search(array $searchParams): ?object
    {
        /*
        * search by organization name and state
         */
        //        $finder = $this->npiRegistry->search
        //            ->where('version', self::DEFAULT_API_VERSION)
        //            ->where('organization_name', 'md**')
        //            ->where('state', 'AL');
        //            ->fetch();

        /** @var \MedicalMundi\NpiRegistry\SDK\NpiRegistry $finder */
        $finder = $this->npiRegistry->search
            ->where('version', self::DEFAULT_API_VERSION);

        // BASE
        if (\array_key_exists('npiNumber', $searchParams) && ('' !== $searchParams['npiNumber'])) {
            $finder->where('number', $searchParams['npiNumber']);
        }
        if (\array_key_exists('npiType', $searchParams) && ('' !== $searchParams['npiType'])) {
            $finder->where('enumeration_type', $searchParams['npiType']);
        }
        if (\array_key_exists('npiTaxonomyDescription', $searchParams) && ('' !== $searchParams['npiTaxonomyDescription'])) {
            $finder->where('taxonomy_description', $searchParams['npiTaxonomyDescription']);
        }

        // INDIVIDUAL
        if (\array_key_exists('providerFirstName', $searchParams) && ('' !== $searchParams['providerFirstName'])) {
            $finder->where('first_name', $searchParams['providerFirstName']);
        }
        if (\array_key_exists('providerLastName', $searchParams) && ('' !== $searchParams['providerLastName'])) {
            $finder->where('last_name', $searchParams['providerLastName']);
        }

        // ORGANIZATION
        if (\array_key_exists('organizationName', $searchParams) && ('' !== $searchParams['organizationName'])) {
            $finder->where('organization_name', (string) $searchParams['organizationName']);
        }
        if (\array_key_exists('aoFirstName', $searchParams) && ('' !== $searchParams['aoFirstName'])) {
            // ??
            $finder->where('??', $searchParams['aoFirstName']);
        }
        if (\array_key_exists('aoLastName', $searchParams) && ('' !== $searchParams['aoLastName'])) {
            // ??
            $finder->where('??', $searchParams['aoLastName']);
        }

        //LOCATION
        if (\array_key_exists('city', $searchParams) && ('' !== $searchParams['city'])) {
            $finder->where('city', $searchParams['city']);
        }
        if (\array_key_exists('state', $searchParams) && ('' !== $searchParams['state'])) {
            $finder->where('state', $searchParams['state']);
        }

        //        if (\array_key_exists('country', $searchParams) && ('' !== $searchParams['country'])) {
        //            $finder->where('country', $searchParams['country']);
        //        }

        if (\array_key_exists('postalCode', $searchParams) && ('' !== $searchParams['postalCode'])) {
            $finder->where('postal_code', $searchParams['postalCode']);
        }

        //        if (\array_key_exists('addressType', $searchParams) && ('' !== $searchParams['addressType'])) {
        //            $finder->where('address_ype', $searchParams['addressType']);
        //        }

        return $finder->fetch();
    }
}
