<?php

namespace App\Domain\Location\Service;

use App\Domain\Location\Data\LocationNearbySearchData;
use App\Domain\Location\Repository\LocationNearbySearchRepository;
use App\Utility\LocationsService;

/**
 * Service.
 */
final class LocationNearbySearch
{
    private $repository;

    public function __construct(LocationNearbySearchRepository $repository)
    {
        $this->repository = $repository;
    }

    public function searchLocationNearby(LocationNearbySearchData $locationNearbySearchData): Array
    {
        $locationNearbySearch = $this->repository->searchLocationNearby($locationNearbySearchData);
        
        $results = [];
        if (isset($locationNearbySearch['hits'])) {
            $results['total'] = $locationNearbySearch['hits']['total'];
        }

        foreach ((array)$locationNearbySearch['hits']['hits'] as $key => $r) {
            $r = (object)$r;
            
            $row = (object)$r->_source;
            $row->id = $r->_id;

            $results['results'][] = LocationsService::returnLocationData($row);
        }
        return $results;
    }
}