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
        $locationId = (int)$args['id'];

        try {

            $locationData = $this->locationReader->getLocationById($locationId);

            $result = [
                'id' => $locationData->id,
                'name' => $locationData->name,
                'address' => $locationData->address,
                'zipcode' => $locationData->zipcode,
                'country' => $locationData->country,
                'state' => $locationData->state,
                'city' => $locationData->city,
                'latitude' => $locationData->latitude,
                'longitude' => $locationData->longitude,
                'createdBy' => $locationData->createdBy,
                'createdOn' => $locationData->createdOn,
                'updatedBy' => $locationData->updatedBy,
                'updatedOn' => $locationData->updatedOn,
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
