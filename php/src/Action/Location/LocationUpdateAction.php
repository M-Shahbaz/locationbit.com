<?php

namespace App\Action\Location;

use App\Domain\Location\Data\LocationUpdateData;
use App\Domain\Location\Service\LocationUpdate;
use App\Utility\CastService;
use DomainException;
use LogicException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use UnexpectedValueException;

final class LocationUpdateAction
{
    private $locationUpdate;
    private $loggerInterface;

    public function __construct(
        LocationUpdate $locationUpdate,
        LoggerInterface $loggerInterface
    ) {
        $this->locationUpdate = $locationUpdate;
        $this->loggerInterface = $loggerInterface;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $jwtUserData = CastService::castJwtUserData($request->getAttribute('jwt'));

        $locationId = (string)$args['id'];

        $data = (array)$request->getParsedBody();

        $locationUpdateData = new LocationUpdateData();
        $locationUpdateData->id = $locationId;
        $locationUpdateData->postcode = $data['postcode'] ?? null;
        $locationUpdateData->lat = $data['lat'] ?? null;
        $locationUpdateData->lon = $data['lon'] ?? null;
        $locationUpdateData->website = $data['website'] ?? null;
        $locationUpdateData->email = $data['email'] ?? null;
        $locationUpdateData->phone = $data['phone'] ?? null;
        $locationUpdateData->googleMaps = $data['googleMaps'] ?? null;
        $locationUpdateData->googleStreetView = $data['googleStreetView'] ?? null;
        $locationUpdateData->facebook = $data['facebook'] ?? null;
        $locationUpdateData->twitter = $data['twitter'] ?? null;
        $locationUpdateData->instagram = $data['instagram'] ?? null;
        $locationUpdateData->youtube = $data['youtube'] ?? null;
        $locationUpdateData->linkedin = $data['linkedin'] ?? null;
        $locationUpdateData->telegram = $data['telegram'] ?? null;
        $locationUpdateData->description = $data['description'] ?? null;
        $locationUpdateData->sector = $data['sector'] ?? null;
        $locationUpdateData->subSector = $data['subSector'] ?? null;
        $locationUpdateData->industryGroup = $data['industryGroup'] ?? null;
        $locationUpdateData->naicsIndustry = $data['naicsIndustry'] ?? null;
        $locationUpdateData->nationalIndustry = $data['nationalIndustry'] ?? null;
        $locationUpdateData->hours = isset($data['hours']) && !empty($data['hours']) ? (array)$data['hours']: null;
        $locationUpdateData->updatedBy = $jwtUserData->userId;

        try {

            //Throwing excemption
            $locationUpdateData->validate();

            $locationUpdated = $this->locationUpdate->updateLocation($locationUpdateData);

            $result = [
                'success' => $locationUpdated
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
