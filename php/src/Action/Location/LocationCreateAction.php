<?php

namespace App\Action\Location;

use App\Domain\Location\Data\LocationCreateData;
use App\Domain\Location\Service\LocationCreator;
use App\Utility\CastService;
use DomainException;
use LogicException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use UnexpectedValueException;

final class LocationCreateAction
{
    private $locationCreator;
    private $loggerInterface;

    public function __construct(
        LocationCreator $locationCreator,
        LoggerInterface $loggerInterface
    ) {
        $this->locationCreator = $locationCreator;
        $this->loggerInterface = $loggerInterface;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $jwtUserData = CastService::castJwtUserData($request->getAttribute('jwt'));

        $data = (array)$request->getParsedBody();

        $locationCreateData = new LocationCreateData();
        $locationCreateData->name = $data['name'] ?? null;
        $locationCreateData->address = $data['address'] ?? null;
        $locationCreateData->postcode = $data['postcode'] ?? null;
        $locationCreateData->country = $data['country'] ?? null;
        $locationCreateData->countrycode = $data['countrycode'] ?? null;
        $locationCreateData->statecode = $data['statecode'] ?? null;
        $locationCreateData->state = $data['state'] ?? null;
        $locationCreateData->city = $data['city'] ?? null;
        $locationCreateData->cityObject = $data['cityObject'] ?? null;
        $locationCreateData->createdBy = $jwtUserData->userId;


        try {
            throw new UnexpectedValueException("Under development!");

            //Throwing excemption
            $locationCreateData->validate();

            $newLocationId = $this->locationCreator->createLocation($locationCreateData);

            $result = [
                'locationId' => $newLocationId
            ];
            $statusCode = 201;
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
