<?php

namespace App\Domain\Location\Service;

use App\Domain\Location\Data\LocationsSearchData;
use App\Domain\Location\Repository\LocationsSearchRepository;
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
        // if (isset($locationsSearch['hits'])) {
        //     return $locationsSearch['hits'];
        // }

        $results = [];
        if (isset($locationsSearch['hits'])) {
            $results['total'] = $locationsSearch['hits']['total'];
        }


        foreach ((array)$locationsSearch['hits']['hits'] as $key => $r) {
            $r = (object)$r;
            
            $row = (object)$r->_source;

            $locationData = new stdClass;
            $locationData->id = isset($r->_id) ? (string)$r->_id : null;
            $locationData->osm_id = isset($row->osm_id) ? $row->osm_id : null;
            $locationData->country = isset($row->country['en']) ? (string)$row->country['en'] : null;
            $locationData->countryDefault = isset($row->country['default']) ? (string)$row->country['default'] : null;
            $locationData->lat = isset($row->coordinate['lat']) ? (float)$row->coordinate['lat'] : null;
            $locationData->lon = isset($row->coordinate['lon']) ? (float)$row->coordinate['lon'] : null;
            $locationData->object_type = isset($row->object_type) ? $row->object_type : null;
            $locationData->city = isset($row->city['en']) ? $row->city['en'] : null;
            $locationData->cityDefault = isset($row->city['default']) ? $row->city['default'] : null;
            $locationData->importance = isset($row->importance) ? $row->importance : null;
            $locationData->countrycode = isset($row->countrycode) ? $row->countrycode : null;
            $locationData->postcode = isset($row->postcode) ? $row->postcode : null;
            $locationData->osm_type = isset($row->osm_type) ? $row->osm_type : null;
            $locationData->osm_key = isset($row->osm_key) ? $row->osm_key : null;
            $locationData->osm_value = isset($row->osm_value) ? $row->osm_value : null;

            $locationData->name = isset($row->name['default']) ? (string)$row->name['default'] : null;
            $locationData->state = isset($row->state['en']) ? (string)$row->state['en'] : null;
            $locationData->stateDefault = isset($row->state['default']) ? (string)$row->state['default'] : null;

            $address = [
                isset($row->street['en']) ? $row->street['en'] : ($row->street['default'] ?? null),
                isset($row->district['en']) ? $row->district['en'] : ($row->district['default'] ?? null),
                isset($row->county) ? $row->county : null
            ];
            $locationData->address = @implode(", ", @array_filter($address));

            $results['results'][] = $locationData;
        }
        return $results;
    }
}
