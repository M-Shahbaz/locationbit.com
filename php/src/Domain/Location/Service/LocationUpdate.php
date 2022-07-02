<?php

namespace App\Domain\Location\Service;

use App\Domain\Location\Data\LocationHistoryCreateData;
use App\Domain\Location\Data\LocationLockCreateData;
use App\Domain\Location\Data\LocationLockUpdateData;
use App\Domain\Location\Data\LocationMysqlData;
use App\Domain\Location\Data\LocationMysqlUpdateData;
use App\Domain\Location\Data\LocationShareUpdateData;
use App\Domain\Location\Data\LocationTicketCreateData;
use App\Domain\Location\Data\LocationUpdateData;
use App\Domain\Location\Repository\LocationUpdateRepository;
use App\Utility\FunctionsService;
use Carbon\Carbon;
use LogicException;
use UnexpectedValueException;

/**
 * Service.
 */
final class LocationUpdate
{
    private $repository;
    private $locationReader;
    private $locationShareUpdate;
    private $locationTicketCreator;
    private $locationHistoryCreator;
    private $locationLockUpdate;
    private $locationLockReader;

    public function __construct(
        LocationUpdateRepository $repository,
        LocationReader $locationReader,
        LocationShareUpdate $locationShareUpdate,
        LocationTicketCreator $locationTicketCreator,
        LocationHistoryCreator $locationHistoryCreator,
        LocationLockUpdate $locationLockUpdate,
        LocationLockReader $locationLockReader
    ) {
        $this->repository = $repository;
        $this->locationReader = $locationReader;
        $this->locationShareUpdate = $locationShareUpdate;
        $this->locationTicketCreator = $locationTicketCreator;
        $this->locationHistoryCreator = $locationHistoryCreator;
        $this->locationLockUpdate = $locationLockUpdate;
        $this->locationLockReader = $locationLockReader;
    }

    public function updateLocation(LocationUpdateData $locationUpdateData): ?string
    {
        $locationUpdateArray = [];

        $locationId = $locationUpdateData->id;
        $userId = $locationUpdateData->updatedBy;

        $locationMysqlData = $this->locationReader->getLocationMysqlByLocationId($locationUpdateData->id);
        $locationMysqlUpdateData = new LocationMysqlUpdateData();
        $locationMysqlUpdateData->locationId = $locationUpdateData->id;


        if (isset($locationUpdateData->postcode)) {
            $locationUpdateArray['postcode'] = !empty($locationUpdateData->postcode) ? $locationUpdateData->postcode : null;
            $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'postcode', $locationUpdateArray['postcode']);

            /*
            $postcode = !empty($locationUpdateData->postcode) ? $locationUpdateData->postcode : null;
            $locationMysqlUpdateArray = [];
            if ($postcode != $locationMysqlData->postcode) {
                $locationUpdateArray['postcode'] = $postcode;

                $locationMysqlUpdateArray['postcode'] = $locationUpdateArray['postcode'];
                $locationMysqlUpdateArray['postcodeOn'] = date('Y-m-d H:i:s');
                $locationMysqlUpdateArray['postcodeBy'] = !empty($locationMysqlUpdateArray['postcode']) ? $userId : null;

                if ((empty($locationMysqlData->postcode) || $locationMysqlData->postcodeBy == $userId)) {

                    $locationShareUpdateData = new LocationShareUpdateData();
                    $locationShareUpdateData->locationId = $locationId;
                    $locationShareUpdateData->userId = $userId;
                    $locationShareUpdateData->postcode = !empty($locationMysqlUpdateArray['postcode']) ? 1 : 0;
                    $locationShareUpdateData->updatedBy = $userId;

                    $locationShareUpdated = $this->locationShareUpdate->updateLocationShare($locationShareUpdateData);

                    $locationTicketCreateData = new LocationTicketCreateData();
                    $locationTicketCreateData->locationId = $locationId;
                    $locationTicketCreateData->userId = $userId;
                    $locationTicketCreateData->field = 'postcode';
                    $locationTicketCreateData->status = null;
                    if (empty($locationMysqlUpdateArray['postcode'])) {
                        if (Carbon::createFromTimeString($locationMysqlData->postcodeOn)->addDays(DAYS_FOR_ZERO_TICKETS_ON_UPDATE)->getTimestamp() < Carbon::now()->getTimestamp()) {
                            $ticketsForEmtpy = -TICKETS;
                        } else {
                            $ticketsForEmtpy = 0;
                        }
                    }
                    $locationTicketCreateData->tickets = !empty($locationMysqlUpdateArray['postcode']) ? TICKETS : $ticketsForEmtpy;
                    $locationTicketCreateData->createdBy = $userId;

                    //Tickets
                    $this->locationTicketCreator->createLocationTicket($locationTicketCreateData);
                }

                if ((!empty($locationMysqlData->postcode)) && $locationMysqlData->postcodeBy != $userId) {

                    $locationLockData = $this->locationLockReader->getLocationLockByLocationIdAndField($locationId, 'postcode');
                    if (
                        (!empty($locationLockData->lockOn) && Carbon::createFromTimeString($locationLockData->lockOn)->addDays(DAYS_FOR_LOCK_ON_UPDATE)->getTimestamp() > Carbon::now()->getTimestamp())
                        ||
                        ($locationLockData->disputed == 1)
                    ) {
                        throw new LogicException("This field is locked for further editing!");
                    }

                    $locationShareUpdateData = new LocationShareUpdateData();
                    $locationShareUpdateData->locationId = $locationId;
                    $locationShareUpdateData->userId = $userId;
                    $locationShareUpdateData->postcode = !empty($locationMysqlUpdateArray['postcode']) ? 1 : 0;
                    $locationShareUpdateData->updatedBy = $userId;

                    $locationShareUpdated = $this->locationShareUpdate->updateLocationShare($locationShareUpdateData);

                    $locationTicketCreateData = new LocationTicketCreateData();
                    $locationTicketCreateData->locationId = $locationId;
                    $locationTicketCreateData->userId = $userId;
                    $locationTicketCreateData->field = 'postcode';
                    $locationTicketCreateData->status = !empty($locationMysqlUpdateArray['postcode']) ? 1 : 2;
                    $locationTicketCreateData->tickets = TICKETS;
                    $locationTicketCreateData->createdBy = $userId;

                    //Tickets
                    $this->locationTicketCreator->createLocationTicket($locationTicketCreateData);

                    //oldUser
                    $locationShareUpdateData = new LocationShareUpdateData();
                    $locationShareUpdateData->locationId = $locationId;
                    $locationShareUpdateData->userId = $locationMysqlData->postcodeBy;
                    $locationShareUpdateData->postcode = 0;
                    $locationShareUpdateData->updatedBy = $userId;

                    $locationShareUpdated = $this->locationShareUpdate->updateLocationShare($locationShareUpdateData);

                    $locationTicketCreateData = new LocationTicketCreateData();
                    $locationTicketCreateData->locationId = $locationId;
                    $locationTicketCreateData->userId = $locationMysqlData->postcodeBy;
                    $locationTicketCreateData->field = 'postcode';
                    $locationTicketCreateData->status = 1;

                    if (Carbon::createFromTimeString($locationMysqlData->postcodeOn)->addDays(DAYS_FOR_ZERO_TICKETS_ON_UPDATE)->getTimestamp() < Carbon::now()->getTimestamp()) {
                        $ticketsForUpdate = -TICKETS;
                    } else {
                        $ticketsForUpdate = 0;
                    }

                    $locationTicketCreateData->tickets = $ticketsForUpdate;
                    $locationTicketCreateData->createdBy = $userId;

                    //Tickets
                    $this->locationTicketCreator->createLocationTicket($locationTicketCreateData);

                    //Lock location field:
                    $locationLockUpdateData = new LocationLockUpdateData();
                    $locationLockUpdateData->locationId = $locationId;
                    $locationLockUpdateData->field = 'postcode';
                    $locationLockUpdateData->lockOn = date('Y-m-d H:i:s');
                    $locationLockUpdateData->updatedBy = $userId;

                    $this->locationLockUpdate->updateLocationLockByLocationIdAndField($locationLockUpdateData);
                }


                $locationHistoryCreateData = new LocationHistoryCreateData();
                $locationHistoryCreateData->locationId = $locationId;
                $locationHistoryCreateData->table = "locations";
                $locationHistoryCreateData->field = "postcode";
                $locationHistoryCreateData->recordId = $locationMysqlData->id;
                $locationHistoryCreateData->oldValue = $locationMysqlData->postcode;
                $locationHistoryCreateData->newValue = $locationUpdateArray['postcode'];
                $locationHistoryCreateData->oldUserId = $locationMysqlData->postcodeBy;
                $locationHistoryCreateData->newUserId = $userId;
                $locationHistoryCreateData->createdBy = $userId;

                //History
                $this->locationHistoryCreator->createLocationHistory($locationHistoryCreateData);
            }

            $locationMysqlUpdated = $this->repository->updateLocationMysqlByLocationId($locationMysqlUpdateArray, $locationMysqlUpdateData);
            */
        }

        if (isset($locationUpdateData->lat) && isset($locationUpdateData->lon)) {
            $locationUpdateArray['coordinate']['lat'] = !empty($locationUpdateData->lat) ? $locationUpdateData->lat : null;
            $locationUpdateArray['coordinate']['lon'] = !empty($locationUpdateData->lon) ? $locationUpdateData->lon : null;

            $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'lat', $locationUpdateArray['coordinate']['lat'], $locationUpdateArray['coordinate']['lon']);
        }

        if (isset($locationUpdateData->website)) {
            $locationUpdateArray['website'] = !empty($locationUpdateData->website) ? $locationUpdateData->website : null;
            $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'website', $locationUpdateArray['website']);
        }

        if (isset($locationUpdateData->email)) {
            $locationUpdateArray['email'] = !empty($locationUpdateData->email) ? $locationUpdateData->email : null;
            $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'email', $locationUpdateArray['email']);
        }

        if (isset($locationUpdateData->phone)) {
            $locationUpdateArray['phone'] = !empty($locationUpdateData->phone) ? $locationUpdateData->phone : null;
            $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'phone', $locationUpdateArray['phone']);
        }

        if (isset($locationUpdateData->whatsApp)) {
            $locationUpdateArray['whatsApp'] = !empty($locationUpdateData->whatsApp) ? $locationUpdateData->whatsApp : null;
            $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'whatsApp', $locationUpdateArray['whatsApp']);
        }

        if (isset($locationUpdateData->googleMaps)) {
            $locationUpdateArray['googleMaps'] = !empty($locationUpdateData->googleMaps) ? $locationUpdateData->googleMaps : null;
            $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'googleMaps', $locationUpdateArray['googleMaps']);
        }

        if (isset($locationUpdateData->googleStreetView)) {
            $locationUpdateArray['googleStreetView'] = !empty($locationUpdateData->googleStreetView) ? $locationUpdateData->googleStreetView : null;
            $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'googleStreetView', $locationUpdateArray['googleStreetView']);
        }

        if (isset($locationUpdateData->facebook)) {
            $locationUpdateArray['facebook'] = !empty($locationUpdateData->facebook) ? $locationUpdateData->facebook : null;
            $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'facebook', $locationUpdateArray['facebook']);
        }

        if (isset($locationUpdateData->twitter)) {
            $locationUpdateArray['twitter'] = !empty($locationUpdateData->twitter) ? $locationUpdateData->twitter : null;
            $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'twitter', $locationUpdateArray['twitter']);
        }

        if (isset($locationUpdateData->instagram)) {
            $locationUpdateArray['instagram'] = !empty($locationUpdateData->instagram) ? $locationUpdateData->instagram : null;
            $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'instagram', $locationUpdateArray['instagram']);
        }

        if (isset($locationUpdateData->youtube)) {
            $locationUpdateArray['youtube'] = !empty($locationUpdateData->youtube) ? $locationUpdateData->youtube : null;
            $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'youtube', $locationUpdateArray['youtube']);
        }

        if (isset($locationUpdateData->linkedin)) {
            $locationUpdateArray['linkedin'] = !empty($locationUpdateData->linkedin) ? $locationUpdateData->linkedin : null;
            $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'linkedin', $locationUpdateArray['linkedin']);
        }

        if (isset($locationUpdateData->telegram)) {
            $locationUpdateArray['telegram'] = !empty($locationUpdateData->telegram) ? $locationUpdateData->telegram : null;
            $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'telegram', $locationUpdateArray['telegram']);
        }

        if (isset($locationUpdateData->description)) {
            $locationUpdateArray['description'] = !empty($locationUpdateData->description) ? $locationUpdateData->description : null;
            $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'description', $locationUpdateArray['description']);
        }

        if (isset($locationUpdateData->sector)) {
            $locationUpdateArray['sector'] = !empty($locationUpdateData->sector) ? (int)$locationUpdateData->sector : null;
            $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'sector', $locationUpdateArray['sector']);
        }

        if (isset($locationUpdateData->subSector)) {
            $locationUpdateArray['subSector'] = !empty($locationUpdateData->subSector) ? (int)$locationUpdateData->subSector : null;
            $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'subSector', $locationUpdateArray['subSector']);
        }

        if (isset($locationUpdateData->industryGroup)) {
            $locationUpdateArray['industryGroup'] = !empty($locationUpdateData->industryGroup) ? (int)$locationUpdateData->industryGroup : null;
            $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'industryGroup', $locationUpdateArray['industryGroup']);
        }

        if (isset($locationUpdateData->naicsIndustry)) {
            $locationUpdateArray['naicsIndustry'] = !empty($locationUpdateData->naicsIndustry) ? (int)$locationUpdateData->naicsIndustry : null;
            $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'naicsIndustry', $locationUpdateArray['naicsIndustry']);
        }

        if (isset($locationUpdateData->nationalIndustry)) {
            $locationUpdateArray['nationalIndustry'] = !empty($locationUpdateData->nationalIndustry) ? (int)$locationUpdateData->nationalIndustry : null;
            $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'nationalIndustry', $locationUpdateArray['nationalIndustry']);
        }

        if (isset($locationUpdateData->hours)) {
            $locationUpdateArray['hours'] = !empty($locationUpdateData->hours) ? (array)$locationUpdateData->hours : null;
            $this->hours($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, $locationUpdateArray['hours']);
        }

        if (!empty($locationUpdateArray)) {
            $locationUpdated = $this->repository->updateLocation($locationUpdateArray, $locationUpdateData);
            return $locationUpdated;
        }

        return null;
    }

    private function ticketLogic(string $locationId, int $userId, LocationMysqlData $locationMysqlData, LocationMysqlUpdateData $locationMysqlUpdateData, string $field, ?string $value, ?string $lon = null)
    {

        $locationMysqlUpdateArray = [];
        if ($value != $locationMysqlData->{$field} || (isset($lon) && $lon != $locationMysqlData->lon)) {

            $fieldShare = $field;
            if ($field == 'lat') {
                $field = 'latlon';
                $fieldShare = $field;
            }
            $fieldBy = "{$field}By";
            $fieldOn = "{$field}On";
            if ($field == 'latlon') {
                $field = 'lat';
            }

            if (isset($lon)) {
                $locationMysqlUpdateArray['lat'] = $value;
                $locationMysqlUpdateArray['lon'] = $lon;
            } else {
                $locationMysqlUpdateArray[$field] = $value;
            }

            $locationMysqlUpdateArray[$fieldOn] = date('Y-m-d H:i:s');
            $locationMysqlUpdateArray[$fieldBy] = !empty($locationMysqlUpdateArray[$field]) ? $userId : null;

            if ((empty($locationMysqlData->{$field}) || $locationMysqlData->{$fieldBy} == $userId)) {

                $locationTicketCreateData = new LocationTicketCreateData();
                $locationTicketCreateData->locationId = $locationId;
                $locationTicketCreateData->userId = $userId;
                $locationTicketCreateData->field = $field == 'lat' ? 'latlon' : $field;
                $locationTicketCreateData->status = null;

                if (is_null($locationMysqlData->{$field})) {
                    $ticketsForEmtpy = TICKETS;
                } else {
                    $ticketsForEmtpy = 0;
                }

                if (empty($locationMysqlUpdateArray[$field])) {
                    if (Carbon::createFromTimeString($locationMysqlData->{$fieldOn})->addDays(DAYS_FOR_ZERO_TICKETS_ON_UPDATE)->getTimestamp() > Carbon::now()->getTimestamp()) {
                        $ticketsForEmtpy = -TICKETS;
                    } else {
                        $ticketsForEmtpy = 0;
                    }
                }

                $locationTicketCreateData->tickets = $ticketsForEmtpy;
                $locationTicketCreateData->createdBy = $userId;

                //Tickets
                if (!empty($ticketsForEmtpy)) {
                    $this->locationTicketCreator->createLocationTicket($locationTicketCreateData);
                }
            }

            if ((!empty($locationMysqlData->{$field})) && $locationMysqlData->{$fieldBy} != $userId) {

                $locationLockData = $this->locationLockReader->getLocationLockByLocationIdAndField($locationId, $field);
                if (
                    (!empty($locationLockData->lockOn) && Carbon::createFromTimeString($locationLockData->lockOn)->addDays(DAYS_FOR_LOCK_ON_UPDATE)->getTimestamp() > Carbon::now()->getTimestamp())
                    ||
                    ($locationLockData->disputed == 1)
                ) {
                    throw new UnexpectedValueException("This field is locked for further editing!");
                }

                $locationTicketCreateData = new LocationTicketCreateData();
                $locationTicketCreateData->locationId = $locationId;
                $locationTicketCreateData->userId = $userId;
                $locationTicketCreateData->field = $field == 'lat' ? 'latlon' : $field;
                $locationTicketCreateData->status = !empty($locationMysqlUpdateArray[$field]) ? 1 : 2;
                $locationTicketCreateData->tickets = TICKETS;
                $locationTicketCreateData->createdBy = $userId;

                //Tickets
                $this->locationTicketCreator->createLocationTicket($locationTicketCreateData);

                //oldUser
                if (!empty($locationMysqlData->{$fieldBy})) {

                    $locationTicketCreateData = new LocationTicketCreateData();
                    $locationTicketCreateData->locationId = $locationId;
                    $locationTicketCreateData->userId = $locationMysqlData->{$fieldBy};
                    $locationTicketCreateData->field = $field == 'lat' ? 'latlon' : $field;
                    $locationTicketCreateData->status = 1;

                    if (Carbon::createFromTimeString($locationMysqlData->{$fieldOn})->addDays(DAYS_FOR_ZERO_TICKETS_ON_UPDATE)->getTimestamp() > Carbon::now()->getTimestamp()) {
                        if (
                            $field == 'lat' &&
                            FunctionsService::getDistanceBetweenPoints(
                                $locationMysqlUpdateArray[$field],
                                $lon,
                                $locationMysqlData->lat,
                                $locationMysqlData->lon
                            ) > 50
                        ) {
                        }
                        $ticketsForUpdate = -TICKETS;
                    } else {
                        $ticketsForUpdate = 0;
                    }

                    $locationTicketCreateData->tickets = $ticketsForUpdate;
                    $locationTicketCreateData->createdBy = $userId;

                    //Tickets
                    $this->locationTicketCreator->createLocationTicket($locationTicketCreateData);
                }

                //Lock location field:
                $locationLockUpdateData = new LocationLockUpdateData();
                $locationLockUpdateData->locationId = $locationId;
                $locationLockUpdateData->field = $field;
                $locationLockUpdateData->lockOn = date('Y-m-d H:i:s');
                $locationLockUpdateData->updatedBy = $userId;

                $this->locationLockUpdate->updateLocationLockByLocationIdAndField($locationLockUpdateData);
            }


            $locationHistoryCreateData = new LocationHistoryCreateData();
            $locationHistoryCreateData->locationId = $locationId;
            $locationHistoryCreateData->table = "locations";
            $locationHistoryCreateData->field = $field;
            $locationHistoryCreateData->recordId = $locationMysqlData->id;
            if ($field == 'lat') {
                $locationHistoryCreateData->oldValue = json_encode([
                    'lat' => $locationMysqlData->lat,
                    'lon' => $locationMysqlData->lon,
                ]);
                $locationHistoryCreateData->newValue = json_encode([
                    'lat' => $locationMysqlUpdateArray['lat'],
                    'lon' => $locationMysqlUpdateArray['lon'],
                ]);
            } else {
                $locationHistoryCreateData->oldValue = $locationMysqlData->{$field};
                $locationHistoryCreateData->newValue = $locationMysqlUpdateArray[$field];
            }
            $locationHistoryCreateData->oldUserId = $locationMysqlData->{$fieldBy};
            $locationHistoryCreateData->newUserId = $userId;
            $locationHistoryCreateData->createdBy = $userId;

            //History
            $this->locationHistoryCreator->createLocationHistory($locationHistoryCreateData);
        }

        $locationMysqlUpdated = $this->repository->updateLocationMysqlByLocationId($locationMysqlUpdateArray, $locationMysqlUpdateData);
    }

    public function hours(string $locationId, int $userId, LocationMysqlData $locationMysqlData, LocationMysqlUpdateData $locationMysqlUpdateData, ?array $hours)
    {
        if(isset($hours)){
            if(isset($hours['monday'])){
                if(array_key_exists('from', $hours['monday'])){
                    $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'hoursMondayFrom', $hours['monday']['from']);
                }
                if(array_key_exists('to', $hours['monday'])){
                    $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'hoursMondayTo', $hours['monday']['to']);
                }
            }
            if(isset($hours['tuesday'])){
                if(array_key_exists('from', $hours['tuesday'])){
                    $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'hoursTuesdayFrom', $hours['tuesday']['from']);
                }
                if(array_key_exists('to', $hours['tuesday'])){
                    $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'hoursTuesdayTo', $hours['tuesday']['to']);
                }
            }
            if(isset($hours['wednesday'])){
                if(array_key_exists('from', $hours['wednesday'])){
                    $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'hoursWednesdayFrom', $hours['wednesday']['from']);
                }
                if(array_key_exists('to', $hours['wednesday'])){
                    $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'hoursWednesdayTo', $hours['wednesday']['to']);
                }
            }
            if(isset($hours['thursday'])){
                if(array_key_exists('from', $hours['thursday'])){
                    $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'hoursThursdayFrom', $hours['thursday']['from']);
                }
                if(array_key_exists('to', $hours['thursday'])){
                    $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'hoursThursdayTo', $hours['thursday']['to']);
                }
            }
            if(isset($hours['friday'])){
                if(array_key_exists('from', $hours['friday'])){
                    $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'hoursFridayFrom', $hours['friday']['from']);
                }
                if(array_key_exists('to', $hours['friday'])){
                    $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'hoursFridayTo', $hours['friday']['to']);
                }
            }
            if(isset($hours['saturday'])){
                if(array_key_exists('from', $hours['saturday'])){
                    $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'hoursSaturdayFrom', $hours['saturday']['from']);
                }
                if(array_key_exists('to', $hours['saturday'])){
                    $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'hoursSaturdayTo', $hours['saturday']['to']);
                }
            }
            if(isset($hours['sunday'])){
                if(array_key_exists('from', $hours['sunday'])){
                    $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'hoursSundayFrom', $hours['sunday']['from']);
                }
                if(array_key_exists('to', $hours['sunday'])){
                    $this->ticketLogic($locationId, $userId, $locationMysqlData, $locationMysqlUpdateData, 'hoursSundayTo', $hours['sunday']['to']);
                }
            }
        }
    }
}
