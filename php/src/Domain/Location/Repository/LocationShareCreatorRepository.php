<?php

namespace App\Domain\Location\Repository;

use App\Domain\Location\Data\LocationShareCreateData;
use Illuminate\Database\Connection;

/**
 * Repository.
 */
class LocationShareCreatorRepository
{
    /**
     * @var connection Eloquent The database connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function insertLocationShare(LocationShareCreateData $locationShareCreateData): Int
    {

        $row = [
            'locationId' => $locationShareCreateData->locationId,
            'userId' => $locationShareCreateData->userId,
            'name' => $locationShareCreateData->name,
            'description' => $locationShareCreateData->description,
            'address' => $locationShareCreateData->address,
            'city' => $locationShareCreateData->city,
            'state' => $locationShareCreateData->state,
            'country' => $locationShareCreateData->country,
            'postcode' => $locationShareCreateData->postcode,
            'latlon' => $locationShareCreateData->latlon,
            'website' => $locationShareCreateData->website,
            'email' => $locationShareCreateData->email,
            'phone' => $locationShareCreateData->phone,
            'googleMaps' => $locationShareCreateData->googleMaps,
            'googleStreetView' => $locationShareCreateData->googleStreetView,
            'facebook' => $locationShareCreateData->facebook,
            'twitter' => $locationShareCreateData->twitter,
            'instagram' => $locationShareCreateData->instagram,
            'youtube' => $locationShareCreateData->youtube,
            'linkedin' => $locationShareCreateData->linkedin,
            'telegram' => $locationShareCreateData->telegram,
            'sector' => $locationShareCreateData->sector,
            'subSector' => $locationShareCreateData->subSector,
            'industryGroup' => $locationShareCreateData->industryGroup,
            'naicsIndustry' => $locationShareCreateData->naicsIndustry,
            'nationalIndustry' => $locationShareCreateData->nationalIndustry,
            'hoursMondayFrom' => $locationShareCreateData->hoursMondayFrom,
            'hoursMondayTo' => $locationShareCreateData->hoursMondayTo,
            'hoursTuesdayFrom' => $locationShareCreateData->hoursTuesdayFrom,
            'hoursTuesdayTo' => $locationShareCreateData->hoursTuesdayTo,
            'hoursWednesdayFrom' => $locationShareCreateData->hoursWednesdayFrom,
            'hoursWednesdayTo' => $locationShareCreateData->hoursWednesdayTo,
            'hoursThursdayFrom' => $locationShareCreateData->hoursThursdayFrom,
            'hoursThursdayTo' => $locationShareCreateData->hoursThursdayTo,
            'hoursFridayFrom' => $locationShareCreateData->hoursFridayFrom,
            'hoursFridayTo' => $locationShareCreateData->hoursFridayTo,
            'hoursSaturdayFrom' => $locationShareCreateData->hoursSaturdayFrom,
            'hoursSaturdayTo' => $locationShareCreateData->hoursSaturdayTo,
            'hoursSundayFrom' => $locationShareCreateData->hoursSundayFrom,
            'hoursSundayTo' => $locationShareCreateData->hoursSundayTo,
            'createdBy' => $locationShareCreateData->createdBy,
        ];

        $insId = (int)$this->connection->table('location_shares')->insertGetId($row);
        return $insId;
    }

}
