<?php

namespace App\Middleware;

use App\Auth\JwtAuth;
use App\Domain\User\Service\UserAuth;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * JWT middleware.
 */
final class JwtMiddleware implements MiddlewareInterface
{
    /**
     * @var JwtAuth
     */
    private $jwtAuth;

    /**
     * @var ResponseFactoryInterface
     */
    private $responseFactory;

    private $userAuth;

    public function __construct(JwtAuth $jwtAuth, ResponseFactoryInterface $responseFactory, UserAuth $userAuth)
    {
        $this->jwtAuth = $jwtAuth;
        $this->responseFactory = $responseFactory;
        $this->userAuth = $userAuth;
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
        $authorization = explode(' ', (string)$request->getHeaderLine('Authorization'));
        $token = $authorization[1] ?? '';

        if (!$token || !$this->jwtAuth->validateToken($token)) {
            return $this->responseFactory->createResponse()
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(401, 'Unauthorized');
        }

        // Append valid token
        $parsedToken = $this->jwtAuth->createParsedToken($token);

        $request = $request->withAttribute('token', $parsedToken);

        // Append the user id as request attribute
        $request = $request->withAttribute('jwtUserId', $parsedToken->getClaim('userId'));
        // Append the user email as request attribute
        $request = $request->withAttribute('email', $parsedToken->getClaim('sub'));
        // Append the user role (e.g: agent = 1, manager = 2 or admin = 3) as request attribute
        $request = $request->withAttribute('role', $parsedToken->getClaim('role'));
        
        $request = $request->withAttribute('name', $parsedToken->getClaim('name'));
        
        return $handler->handle($request);
    }
}