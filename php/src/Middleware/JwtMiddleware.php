<?php

namespace App\Middleware;

use App\Domain\Jwt\Service\JwtAuth;
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

    public function __construct(JwtAuth $jwtAuth, ResponseFactoryInterface $responseFactory)
    {
        $this->jwtAuth = $jwtAuth;
        $this->responseFactory = $responseFactory;
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
/*         // var_dump($request->getHeaderLine('Cookie'));
        $authorization = explode(' ', (string)$request->getHeaderLine('Authorization'));

        $token = $authorization[1] ?? '';

        if (!$token) {

            $headerCookies = explode('; ', (string)$request->getHeaderLine('Cookie'));

            foreach ($headerCookies as $value) {
                list($key, $val) = explode('=', $value, 2);
                if ($key == 'next-auth.session-token') {
                    $token = $val;
                }
            }
        }

        if (!$token || !$this->jwtAuth->validateToken($token)) {
            return $this->responseFactory->createResponse()
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(401, 'Unauthorized');
        }

        // Append valid token
        $parsedToken = $this->jwtAuth->createParsedToken($token);

        $request = $request->withAttribute('token', $parsedToken);

        // Append the user id as request attribute
        // $request = $request->withAttribute('jwtUserId', $parsedToken->getClaim('userId'));
        // Append the user email as request attribute
        $request = $request->withAttribute('email', $parsedToken->getClaim('email'));

        $request = $request->withAttribute('sub', $parsedToken->getClaim('sub'));
        // Append the user role (e.g: agent = 1, manager = 2 or admin = 3) as request attribute
        // $request = $request->withAttribute('role', $parsedToken->getClaim('role'));

        $request = $request->withAttribute('name', $parsedToken->getClaim('name'));
 */
        return $handler->handle($request);
    }
}
