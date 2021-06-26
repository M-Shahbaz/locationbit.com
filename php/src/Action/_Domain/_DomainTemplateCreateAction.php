<?php

namespace App\Action\_Domain;

use App\Domain\_Domain\Data\_DomainTemplateCreateData;
use App\Domain\_Domain\Service\_DomainTemplateCreator;
use App\Utility\CastService;
use DomainException;
use LogicException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use UnexpectedValueException;

final class _DomainTemplateCreateAction
{
    private $_domainTemplateCreator;
    private $loggerInterface;

    public function __construct(
        _DomainTemplateCreator $_domainTemplateCreator,
        LoggerInterface $loggerInterface
    ) {
        $this->_domainTemplateCreator = $_domainTemplateCreator;
        $this->loggerInterface = $loggerInterface;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $jwtUserData = CastService::castJwtUserData($request->getAttribute('jwtUserData'));

        $_domainTemplateId = (int)$args['id'];

        $data = (array)$request->getParsedBody();


        $_domainTemplateCreateData = new _DomainTemplateCreateData();
        $_domainTemplateCreateData->title = $data['title'];
        $_domainTemplateCreateData->location = $data['location'];
        $_domainTemplateCreateData->start = isset($data['start']) ? date('Y-m-d H:i:s', strtotime($data['start'])) : null;
        $_domainTemplateCreateData->end = isset($data['end']) ? date('Y-m-d H:i:s', strtotime($data['end'])) : null;
        $_domainTemplateCreateData->leadId = $data['leadId'];
        $_domainTemplateCreateData->customerId = $data['customerId'];
        $_domainTemplateCreateData->sourceId = $data['sourceId'];
        $_domainTemplateCreateData->feedbackId = $data['feedbackId'];
        $_domainTemplateCreateData->createdBy = $jwtUserData->userId;


        try {

            //Throwing excemption
            $_domainTemplateCreateData->validate();

            $new_DomainTemplateId = $this->_domainTemplateCreator->create_DomainTemplate($_domainTemplateCreateData);

            $result = [
                '_domainTemplateId' => $new_DomainTemplateId
            ];
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
