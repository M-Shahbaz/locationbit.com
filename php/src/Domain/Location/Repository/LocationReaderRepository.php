<?php

namespace App\Domain\Location\Repository;

use App\Domain\Location\Data\LocationData;
use DomainException;
use Elasticsearch\Client;

/**
 * Repository.
 */
class LocationReaderRepository
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getLocationById(string $id): LocationData
    {

        $params = [
            'index' => 'locations',
            'id'    => $id
        ];

        try {
            $row = (object)$this->client->getSource($params);
            $row->id = $id;
        } catch (\Throwable $th) {
            throw new DomainException(sprintf('Location not found by id: %s', $id));
        }


        $locationData = new LocationData();
        $locationData->id = isset($row->id) ? (string)$row->id : null;
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
        $locationData->address = implode(", ", array_filter($address));

        // $locationData->createdBy = $row->createdBy ? (int)$row->createdBy : null;
        // $locationData->createdOn = $row->createdOn ? (string)$row->createdOn : null;
        // $locationData->deletedBy = $row->deletedBy ? (int)$row->deletedBy : null;
        // $locationData->deletedOn = $row->deletedOn ? (string)$row->deletedOn : null;
        // $locationData->updatedBy = $row->updatedBy ? (int)$row->updatedBy : null;
        // $locationData->updatedOn = $row->updatedOn ? (string)$row->updatedOn : null;

        $locationData->website = isset($row->website) ? $row->website : null;
        $locationData->email = isset($row->email) ? $row->email : null;
        $locationData->phone = isset($row->phone) ? $row->phone : null;
        $locationData->description = isset($row->description) ? $row->description : null;

        return $locationData;
    }
}
