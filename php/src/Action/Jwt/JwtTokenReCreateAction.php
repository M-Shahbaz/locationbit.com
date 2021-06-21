<?php

namespace App\Action\Jwt;

use App\Domain\Jwt\Service\JwtTokenReCreator;
use App\Domain\User\Service\UserReader;
use App\Utility\CastService;
use DomainException;
use LogicException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use UnexpectedValueException;

final class JwtTokenReCreateAction
{
    private $jwtTokenReCreator;
    private $loggerInterface;
    private $userReader;

    public function __construct(
        JwtTokenReCreator $jwtTokenReCreator,
        LoggerInterface $loggerInterface,
        UserReader $userReader
    ) {
        $this->jwtTokenReCreator = $jwtTokenReCreator;
        $this->loggerInterface = $loggerInterface;
        $this->userReader = $userReader;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $jwtUserData = CastService::castJwtUserData($request->getAttribute('jwt'));
        try {

            // $newJwtToken = $this->jwtTokenReCreator->reCreateJwtToken($email);

            if (empty($jwtUserData->userId)) {
                $userData = $this->userReader->getUserByJwtUserDataEmail($jwtUserData);

                $result = [
                    'userId' => $userData->id,
                    'role' => $userData->role,
                    // 'jwt' => $newJwtToken,
                ];
            }else{
                $result = $jwtUserData;
            }

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
