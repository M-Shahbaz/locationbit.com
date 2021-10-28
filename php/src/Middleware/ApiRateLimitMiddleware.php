<?php

namespace App\Middleware;

use App\Domain\Location\Repository\LocationHistoryReaderRepository;
use App\Utility\CastService;
use App\Utility\IpService;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * JWT middleware.
 */
final class ApiRateLimitMiddleware implements MiddlewareInterface
{
    /**
     * @var ResponseFactoryInterface
     */
    private $responseFactory;
    private $locationHistoryReaderRepository;

    public function __construct(
        ResponseFactoryInterface $responseFactory,
        LocationHistoryReaderRepository $locationHistoryReaderRepository
    ) {
        $this->responseFactory = $responseFactory;
        $this->locationHistoryReaderRepository = $locationHistoryReaderRepository;
    }

    /**
     * Invoke middleware.
     *
     * @param ServerRequestInterface $request The request
     * @param RequestHandlerInterface $handler The handler
     *
     * @return ResponseInterface The response
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $jwtUserData = CastService::castJwtUserData($request->getAttribute('jwt'));

        if (!in_array($jwtUserData->userId, API_RATE_LIMIT_PASSTHROUGH_USERS) && !empty($this->locationHistoryReaderRepository->countApiLogsLimitPerMinute($jwtUserData->userId, API_RATE_LIMIT_PER_MINUTE))) {
            return $this->responseFactory->createResponse()
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(429); //Limit per minute reached
        }

        return $handler->handle($request);
    }
}
