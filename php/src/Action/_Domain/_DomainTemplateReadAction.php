<?php

namespace App\Action\_Domain;

use App\Domain\_Domain\Data\_DomainTemplateReadRequestData;
use App\Domain\_Domain\Service\_DomainTemplateReader;
use App\Utility\CastService;
use DomainException;
use LogicException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use UnexpectedValueException;

final class _DomainTemplateReadAction
{
    private $_domainTemplateReader;
    private $loggerInterface;

    public function __construct(
        _DomainTemplateReader $_domainTemplateReader,
        LoggerInterface $loggerInterface
    ) {
        $this->_domainTemplateReader = $_domainTemplateReader;
        $this->loggerInterface = $loggerInterface;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $jwtUserData = CastService::castJwtUserData($request->getAttribute('jwtUserData'));

        $_domainTemplateId = (int)$args['id'];

        $data = (array)$request->getParsedBody();

        $_domainTemplateReadRequestData = new _DomainTemplateReadRequestData();
        $_domainTemplateReadRequestData->jwtUserId = $jwtUserData->uid;
        $_domainTemplateReadRequestData->_domainTemplateId = $_domainTemplateId;

        try {

            $_domainTemplateReadRequestData->validate();

            $_domainTemplateData = $this->_domainTemplateReader->get_DomainTemplateById($_domainTemplateReadRequestData);

            $result = [
                'id' => $_domainTemplateData->id,
                'dataKey' => $_domainTemplateData->dataKey,
                'dataValue' => $_domainTemplateData->dataValue,
                'createdOn' => $_domainTemplateData->createdOn,
            ];

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
