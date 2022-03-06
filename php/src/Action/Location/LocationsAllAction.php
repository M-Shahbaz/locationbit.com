<?php

namespace App\Action\Location;

use App\Domain\Location\Data\LocationsSearchData;
use App\Domain\Location\Service\LocationsSearch;
use App\Domain\Sitemap\Service\SitemapCreator;
use App\Utility\CastService;
use DomainException;
use LogicException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use UnexpectedValueException;

final class LocationsAllAction
{
    private $locationsSearch;
    private $loggerInterface;
    private $sitemapCreator;

    public function __construct(
        LocationsSearch $locationsSearch,
        LoggerInterface $loggerInterface,
        SitemapCreator $sitemapCreator
    ) {
        $this->locationsSearch = $locationsSearch;
        $this->loggerInterface = $loggerInterface;
        $this->sitemapCreator = $sitemapCreator;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {

        $locationsSearchData = new LocationsSearchData();
        $locationsSearchData->limit = 100;
        $locationsSearchData->offset = 0;


        try {

            // $locationsSearch = $this->locationsSearch->allLocations($locationsSearchData);
            // $result = $locationsSearch;
            $this->sitemapCreator->createSitemap();
            $result = 1;
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
