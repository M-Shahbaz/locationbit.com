<?php

namespace App\Domain\Location\Service;

use App\Domain\Location\Data\LocationCitiesSearchData;
use App\Domain\Location\Repository\LocationCitiesSearchRepository;
use App\Utility\LocationsService;

/**
 * Service.
 */
final class LocationCitiesSearch
{
    private $repository;

    public function __construct(LocationCitiesSearchRepository $repository)
    {
        $this->repository = $repository;
    }

    public function searchLocationCities(LocationCitiesSearchData $locationCitiesSearchData): Array
    {
        $locationCitiesSearch = $this->repository->searchLocationCities($locationCitiesSearchData);
        
        $results = [];
        if (isset($locationCitiesSearch['hits'])) {
            $results['total'] = $locationCitiesSearch['hits']['total'];
        }


        foreach ((array)$locationCitiesSearch['hits']['hits'] as $key => $r) {
            $r = (object)$r;
            
            $row = (object)$r->_source;
            $row->id = $r->_id;

            $results['results'][] = LocationsService::returnLocationData($row);
        }
        return $results;
    }
}