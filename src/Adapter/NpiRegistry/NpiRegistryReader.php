<?php declare(strict_types=1);

namespace OpenEMR\Modules\NpiRegistry\Adapter\NpiRegistry;

use MedicalMundi\NpiRegistry\SDK\NpiRegistry;
use OpenEMR\Modules\NpiRegistry\Application\NpiRegistryReaderInterface;

class NpiRegistryReader implements NpiRegistryReaderInterface
{
    private const DEFAULT_API_VERSION = '2.1';

    private NpiRegistry $npiRegistry;

    public function __construct(NpiRegistry $npiRegistry)
    {
        $this->npiRegistry = $npiRegistry;
    }

    public function search(array $searchParams): ?object
    {
        /** @var \MedicalMundi\NpiRegistry\SDK\NpiRegistry $finder */
        $finder = $this->npiRegistry->search
            ->where('version', self::DEFAULT_API_VERSION)
            ->where('exactMatch', false)
            ->where('pretty', false)
            ->where('limit', 100); // limit range 0 - 200

        // BASE SEARCH
        if (\array_key_exists('npiNumber', $searchParams) && ('' !== $searchParams['npiNumber'])) {
            $finder->where('number', $searchParams['npiNumber']);
        } else {
            $finder->where('number', null);
        }

        if (\array_key_exists('npiType', $searchParams) && ('' !== $searchParams['npiType'])) {
            $finder->where('enumeration_type', $searchParams['npiType']);
        } else {
            $finder->where('enumeration_type', null);
        }

        if (\array_key_exists('npiTaxonomyDescription', $searchParams) && ('' !== $searchParams['npiTaxonomyDescription'])) {
            $finder->where('taxonomy_description', $searchParams['npiTaxonomyDescription']);
        } else {
            $finder->where('taxonomy_description', null);
        }

        // INDIVIDUAL SEARCH
        if (\array_key_exists('providerFirstName', $searchParams) && ('' !== $searchParams['providerFirstName'])) {
            $finder->where('first_name', $searchParams['providerFirstName']);

            // TODO verify correct
            $finder->where('name_purpose', 'Provider');
        } else {
            $finder->where('first_name', null);
        }

        if (\array_key_exists('providerLastName', $searchParams) && ('' !== $searchParams['providerLastName'])) {
            $finder->where('last_name', $searchParams['providerLastName']);
            // TODO verify correct
            $finder->where('name_purpose', 'Provider');
        } else {
            $finder->where('last_name', null);
        }

        // ORGANIZATION SEARCH
        if (\array_key_exists('organizationName', $searchParams) && ('' !== $searchParams['organizationName'])) {
            $finder->where('organization_name', (string) $searchParams['organizationName']);
        } else {
            $finder->where('organization_name', null);
        }

        if (\array_key_exists('aoFirstName', $searchParams) && ('' !== $searchParams['aoFirstName'])) {
            // ??
            $finder->where('??', $searchParams['aoFirstName']);
        } else {
            $finder->where('aoFirstName', null);
        }

        if (\array_key_exists('aoLastName', $searchParams) && ('' !== $searchParams['aoLastName'])) {
            // ??
            $finder->where('??', $searchParams['aoLastName']);
        } else {
            $finder->where('aoLastName', null);
        }

        //LOCATION SEARCH
        if (\array_key_exists('city', $searchParams) && ('' !== $searchParams['city'])) {
            $finder->where('city', $searchParams['city']);
        } else {
            $finder->where('city', null);
        }

        if (\array_key_exists('state', $searchParams) && ('' !== $searchParams['state'])) {
            $finder->where('state', $searchParams['state']);
        } else {
            $finder->where('state', null);
        }

        if (\array_key_exists('country', $searchParams) && ('' !== $searchParams['country'])) {
            $finder->where('country', $searchParams['country']);
        } else {
            $finder->where('country', null);
        }

        if (\array_key_exists('postalCode', $searchParams) && ('' !== $searchParams['postalCode'])) {
            $finder->where('postal_code', $searchParams['postalCode']);
        } else {
            $finder->where('postal_code', null);
        }

        if (\array_key_exists('addressType', $searchParams) && ('' !== $searchParams['addressType'])) {
            $finder->where('address_ype', $searchParams['addressType']);
        } else {
            $finder->where('address_ype', null);
        }

        return $finder->fetch();
    }
}
