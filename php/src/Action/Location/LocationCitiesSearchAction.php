<?php

namespace App\Action\Location;

use App\Domain\Location\Data\LocationCitiesSearchData;
use App\Domain\Location\Service\LocationCitiesSearch;
use App\Utility\CastService;
use DomainException;
use LogicException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use UnexpectedValueException;

final class LocationCitiesSearchAction
{
    private $locationCitiesSearch;
    private $loggerInterface;

    public function __construct(
        LocationCitiesSearch $locationCitiesSearch,
        LoggerInterface $loggerInterface
    ) {
        $this->locationCitiesSearch = $locationCitiesSearch;
        $this->loggerInterface = $loggerInterface;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $page = isset($args['page']) && $args['page'] > 0 ? $args['page'] : 1;
        $limit = isset($args['limit']) && $args['limit'] > 0 && $args['limit'] < 100 ? $args['limit'] : 10;
        $offset = --$page * $limit;

        $locationCitiesSearchData = new LocationCitiesSearchData();
        $locationCitiesSearchData->city = $args['city'] ?? NULL;
        $locationCitiesSearchData->limit = $limit;
        $locationCitiesSearchData->offset = $offset;


        try {

            //Throwing excemption
            $locationCitiesSearchData->validate();

            $locationCitiesSearch = $this->locationCitiesSearch->searchLocationCities($locationCitiesSearchData);

            $result = $locationCitiesSearch;
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
