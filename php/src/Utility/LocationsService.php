<?php

namespace App\Utility;

use App\Domain\Location\Data\LocationData;

/**
 * Summary of _functions
 */
class LocationsService 
{

    public static function returnLocationData($row): LocationData
    {

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
            isset($row->county['en']) ? $row->county['en'] : ($row->county['default'] ?? null),
        ];
        $locationData->address = @implode(", ", @array_filter($address));

        // $locationData->createdBy = $row->createdBy ? (int)$row->createdBy : null;
        // $locationData->createdOn = $row->createdOn ? (string)$row->createdOn : null;
        // $locationData->deletedBy = $row->deletedBy ? (int)$row->deletedBy : null;
        // $locationData->deletedOn = $row->deletedOn ? (string)$row->deletedOn : null;
        // $locationData->updatedBy = $row->updatedBy ? (int)$row->updatedBy : null;
        // $locationData->updatedOn = $row->updatedOn ? (string)$row->updatedOn : null;

        $locationData->website = isset($row->website) ? $row->website : null;
        $locationData->email = isset($row->email) ? $row->email : null;
        $locationData->phone = isset($row->phone) ? $row->phone : null;
        $locationData->googleMaps = isset($row->googleMaps) ? $row->googleMaps : null;
        $locationData->googleStreetView = isset($row->googleStreetView) ? $row->googleStreetView : null;
        $locationData->facebook = isset($row->facebook) ? $row->facebook : null;
        $locationData->twitter = isset($row->twitter) ? $row->twitter : null;
        $locationData->instagram = isset($row->instagram) ? $row->instagram : null;
        $locationData->youtube = isset($row->youtube) ? $row->youtube : null;
        $locationData->linkedin = isset($row->linkedin) ? $row->linkedin : null;
        $locationData->telegram = isset($row->telegram) ? $row->telegram : null;
        $locationData->description = isset($row->description) ? $row->description : null;
        $locationData->sector = isset($row->sector) ? $row->sector : null;
        $locationData->subSector = isset($row->subSector) ? $row->subSector : null;
        $locationData->industryGroup = isset($row->industryGroup) ? $row->industryGroup : null;
        $locationData->naicsIndustry = isset($row->naicsIndustry) ? $row->naicsIndustry : null;
        $locationData->nationalIndustry = isset($row->nationalIndustry) ? $row->nationalIndustry : null;
        $locationData->hours = isset($row->hours) ? $row->hours : null;

        return $locationData;   
    }

}

