<?php

namespace App\Action;

use App\Domain\Bing\Service\BingMapsGeocodingReader;
use DomainException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use UnexpectedValueException;

final class TestAction
{
    private $srv;

    public function __construct(BingMapsGeocodingReader $bingMapsGeocodingReader)
    {
        $this->srv = $bingMapsGeocodingReader;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        try {

            $this->srv->getBingMapsGeocodingByAddress("Al Masjid an Nabawi, Al Haram, Medina 42311, Saudi Arabia");
            
            $result = "786/92";
        } catch (UnexpectedValueException $un) {
            $result = [
                'error' => "UnexpectedValue: " . $un->getMessage()
            ];
            $statusCode = 400;
        } catch (DomainException $do) {
            $result = [
                'error' => "DomainException: " . $do->getMessage()
            ];
            $statusCode = 400;
        } catch (\Throwable $th) {
            $result = [
                'error' => $th->getMessage()
            ];
            $statusCode = 400;
        }

        $response->getBody()
                 ->write((string)json_encode($result));
        return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus($statusCode ?? 200);
    }
}
