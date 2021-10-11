<?php

namespace App\Action\Location;

use App\Domain\Location\Data\LocationsSearchData;
use App\Domain\Location\Service\LocationsSearch;
use App\Utility\CastService;
use DomainException;
use LogicException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use UnexpectedValueException;

final class LocationsSearchAction
{
    private $locationsSearch;
    private $loggerInterface;

    public function __construct(
        LocationsSearch $locationsSearch,
        LoggerInterface $loggerInterface
    ) {
        $this->locationsSearch = $locationsSearch;
        $this->loggerInterface = $loggerInterface;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $data = (array)$request->getParsedBody();

        $page = isset($args['page']) && $args['page'] > 0 ? $args['page'] : 1;
        $limit = isset($args['limit']) && $args['limit'] > 0 && $args['limit'] < 100 ? $args['limit'] : 10;
        $offset = --$page * $limit;

        $locationsSearchData = new LocationsSearchData();
        $locationsSearchData->q = $data['q'] ?? null;
        $locationsSearchData->limit = $limit;
        $locationsSearchData->offset = $offset;


        try {

            //Throwing excemption
            $locationsSearchData->validate();

            $locationsSearch = $this->locationsSearch->searchLocations($locationsSearchData);

            $result = $locationsSearch;
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
