<?php

namespace App\Action\Location;

use App\Domain\Location\Service\LocationReader;
use DomainException;
use LogicException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use UnexpectedValueException;

final class LocationReadAction
{
    private $locationReader;
    private $loggerInterface;

    public function __construct(
        LocationReader $locationReader,
        LoggerInterface $loggerInterface
    ) {
        $this->locationReader = $locationReader;
        $this->loggerInterface = $loggerInterface;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $locationId = (string)$args['id'];

        try {

            $locationData = $this->locationReader->getLocationByIdWithSimilarAndNearByLocations($locationId);

            $result = [
                'id' => $locationData->id,
                'osm_id' => $locationData->osm_id,
                'country' => $locationData->country,
                'countryDefault' => $locationData->countryDefault,
                'lat' => $locationData->lat,
                'lon' => $locationData->lon,
                'object_type' => $locationData->object_type,
                'city' => $locationData->city,
                'cityDefault' => $locationData->cityDefault,
                'importance' => $locationData->importance,
                'countrycode' => $locationData->countrycode,
                'postcode' => $locationData->postcode,
                'osm_type' => $locationData->osm_type,
                'osm_key' => $locationData->osm_key,
                'osm_value' => $locationData->osm_value,
                'name' => $locationData->name,
                'state' => $locationData->state,
                'stateDefault' => $locationData->stateDefault,
                'address' => $locationData->address,
                'createdBy' => $locationData->createdBy,
                'createdOn' => $locationData->createdOn,
                'updatedBy' => $locationData->updatedBy,
                'updatedOn' => $locationData->updatedOn,

                'website' => $locationData->website,
                'email' => $locationData->email,
                'phone' => $locationData->phone,
                'googleMaps' => $locationData->googleMaps,
                'googleStreetView' => $locationData->googleStreetView,
                'facebook' => $locationData->facebook,
                'twitter' => $locationData->twitter,
                'instagram' => $locationData->instagram,
                'youtube' => $locationData->youtube,
                'linkedin' => $locationData->linkedin,
                'telegram' => $locationData->telegram,
                'description' => $locationData->description,
                'sector' => (string)$locationData->sector,
                'subSector' => (string)$locationData->subSector,
                'industryGroup' => (string)$locationData->industryGroup,
                'naicsIndustry' => (string)$locationData->naicsIndustry,
                'nationalIndustry' => (string)$locationData->nationalIndustry,
                'hours' => $locationData->hours,
                
                'similarLocations' => $locationData->similarLocations,
                'nearbyLocations' => $locationData->nearbyLocations,
            ];

            $statusCode = 200;
        } catch (UnexpectedValueException $un) {
            $result = [
                'error' => "UnexpectedValue: " . $un->getMessage()
            ];
            $statusCode = 400;

            if (APP_LOG_ERRORS) {
                $this->loggerInterface->error($un);
            }
        } catch (DomainException $do) {
            $result = [
                'error' => "DomainException: " . $do->getMessage()
            ];
            $statusCode = 400;

            if (APP_LOG_ERRORS) {
                $this->loggerInterface->error($do);
            }
        } catch (LogicException $e) {
            //Direct error message:
            $statusCode = !empty($e->getCode()) ? $e->getCode() : 400;
            $response->getBody()->write((string)$e->getMessage());
            return $response->withHeader('Content-Type', 'application/json')
                ->withStatus($statusCode ?? 400);

            if (APP_LOG_ERRORS) {
                $this->loggerInterface->error($e);
            }
        } catch (\Throwable $th) {
            $result = [
                'error' => $th->getMessage()
            ];
            $statusCode = 400;

            if (APP_LOG_ERRORS) {
                $this->loggerInterface->error($th);
            }
        }

        $response->getBody()->write((string)json_encode($result));
        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus($statusCode ?? 200);
    }
}
