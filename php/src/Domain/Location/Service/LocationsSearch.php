<?php

namespace App\Domain\Location\Service;

use App\Domain\Location\Data\LocationsSearchData;
use App\Domain\Location\Repository\LocationsSearchRepository;
use App\Utility\LocationsService;
use stdClass;

/**
 * Service.
 */
final class LocationsSearch
{
    private $repository;

    public function __construct(LocationsSearchRepository $repository)
    {
        $this->repository = $repository;
    }

    public function searchLocations(LocationsSearchData $locationsSearchData): array
    {
        $locationsSearch = $this->repository->searchLocations($locationsSearchData);

        $results = [];
        if (isset($locationsSearch['hits'])) {
            $results['total'] = $locationsSearch['hits']['total'];
        }


        foreach ((array)$locationsSearch['hits']['hits'] as $key => $r) {
            $r = (object)$r;
            
            $row = (object)$r->_source;
            $row->id = $r->_id;

            $results['results'][] = LocationsService::returnLocationData($row);
        }
        return $results;
    }

    public function allLocations(LocationsSearchData $locationsSearchData): array
    {
        $locationsSearch = $this->repository->allLocations($locationsSearchData);

        $results = [];
        if (isset($locationsSearch['hits'])) {
            $results['total'] = $locationsSearch['hits']['total'];
        }


        foreach ((array)$locationsSearch['hits']['hits'] as $key => $r) {
            $r = (object)$r;
            
            $row = (object)$r->_source;
            $row->id = $r->_id;
            
            $results['results'][] = LocationsService::returnLocationData($row);
        }
        return $results;
    }
}
