<?php

namespace App\Action\_Domain;

use App\Domain\_Domain\Data\_DomainTemplateDeleteData;
use App\Domain\_Domain\Service\_DomainTemplateDelete;
use App\Utility\CastService;
use DomainException;
use LogicException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use UnexpectedValueException;

final class _DomainTemplateDeleteAction
{
    private $_domainTemplateDelete;
    private $loggerInterface;

    public function __construct(
        _DomainTemplateDelete $_domainTemplateDelete,
        LoggerInterface $loggerInterface
    ) {
        $this->_domainTemplateDelete = $_domainTemplateDelete;
        $this->loggerInterface = $loggerInterface;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $jwtUserData = CastService::castJwtUserData($request->getAttribute('jwt'));

        $_domainTemplateId = (int)$args['id'];

        $data = (array)$request->getParsedBody();

        $_domainTemplateDeleteData = new _DomainTemplateDeleteData();
        $_domainTemplateDeleteData->id = $_domainTemplateId;
        $_domainTemplateDeleteData->deletedBy = $jwtUserData->userId;


        try {

            //Throwing excemption
            $_domainTemplateDeleteData->validate();

            $_domainTemplateDeleted = $this->_domainTemplateDelete->delete_DomainTemplate($_domainTemplateDeleteData);

            $result = [
                'success' => $_domainTemplateDeleted
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
