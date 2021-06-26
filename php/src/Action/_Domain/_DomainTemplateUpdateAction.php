<?php

namespace App\Action\_Domain;

use App\Domain\_Domain\Data\_DomainTemplateUpdateData;
use App\Domain\_Domain\Service\_DomainTemplateUpdate;
use App\Utility\CastService;
use DomainException;
use LogicException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use UnexpectedValueException;

final class _DomainTemplateUpdateAction
{
    private $_domainTemplateUpdate;
    private $loggerInterface;

    public function __construct(
        _DomainTemplateUpdate $_domainTemplateUpdate,
        LoggerInterface $loggerInterface
    ) {
        $this->_domainTemplateUpdate = $_domainTemplateUpdate;
        $this->loggerInterface = $loggerInterface;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $jwtUserData = CastService::castJwtUserData($request->getAttribute('jwtUserData'));

        $_domainTemplateId = (int)$args['id'];

        $data = (array)$request->getParsedBody();

        $_domainTemplateUpdateData = new _DomainTemplateUpdateData();
        $_domainTemplateUpdateData->id = $_domainTemplateId;
        $_domainTemplateUpdateData->title = $data['title'] ?? NULL;
        $_domainTemplateUpdateData->location = $data['location'] ?? NULL;
        $_domainTemplateUpdateData->start = isset($data['start']) ? date('Y-m-d H:i:s', strtotime($data['start'])) : NULL;
        $_domainTemplateUpdateData->end = isset($data['end']) ? date('Y-m-d H:i:s', strtotime($data['end'])) : NULL;
        $_domainTemplateUpdateData->resheduledOn = $data['resheduledOn'] ?? NULL;
        $_domainTemplateUpdateData->resheduledBy = $data['resheduledBy'] ?? NULL;
        $_domainTemplateUpdateData->updatedBy = $jwtUserData->userId;


        try {

            //Throwing excemption
            $_domainTemplateUpdateData->validate();

            $_domainTemplateUpdated = $this->_domainTemplateUpdate->update_DomainTemplate($_domainTemplateUpdateData);

            $result = [
                'success' => $_domainTemplateUpdated
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
