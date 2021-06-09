<?php

namespace App\Action;

use DomainException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use UnexpectedValueException;

final class TestAction
{
    private $srv;

    public function __construct()
    {
        $this->srv;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        try {
            
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
