<?php

namespace App\Middleware;

use App\Utility\IpService;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * JWT middleware.
 */
final class GoogleReCaptchaMiddleware implements MiddlewareInterface
{
    /**
     * @var ResponseFactoryInterface
     */
    private $responseFactory;

    public function __construct(ResponseFactoryInterface $responseFactory)
    {
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
        $data = (array)$request->getParsedBody();

        if (!isset($data['keyNumber']) || !isset($data['recaptchaToken'])) {
            return $this->responseFactory->createResponse()
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(401, 'Unauthorized');
        }

        $client = new \GuzzleHttp\Client();

        $url = "https://www.google.com/recaptcha/api/siteverify";
        $response = $client->post($url, [
            'form_params' => [
                'secret' => getenv("RECAPTCHA_SECRET_KEY_" . $data['keyNumber']),
                'response' => $data['recaptchaToken']
            ]
        ]);

        $result = $response->getBody()->getContents();
        $result = json_decode($result);

        if (empty($result->success)) {
            return $this->responseFactory->createResponse()
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(403);
        }


        return $handler->handle($request);
    }
}
