<?php

namespace App\Action\_Domain;

use App\Domain\_Domain\Data\_DomainTemplateConfirmData;
use App\Domain\_Domain\Service\_DomainTemplateConfirm;
use App\Utility\CastService;
use DomainException;
use LogicException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use UnexpectedValueException;

final class _DomainTemplateConfirmAction
{
    private $_domainTemplateConfirm;
    private $loggerInterface;

    public function __construct(
        _DomainTemplateConfirm $_domainTemplateConfirm,
        LoggerInterface $loggerInterface
    ) {
        $this->_domainTemplateConfirm = $_domainTemplateConfirm;
        $this->loggerInterface = $loggerInterface;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $jwtUserData = CastService::castJwtUserData($request->getAttribute('jwtUserData'));

        $_domainTemplateId = (int)$args['id'];

        $data = (array)$request->getParsedBody();

        $_domainTemplateConfirmData = new _DomainTemplateConfirmData();
        $_domainTemplateConfirmData->id = $_domainTemplateId;
        $_domainTemplateConfirmData->userId = $jwtUserData->userId;


        try {

            //Throwing excemption
            $_domainTemplateConfirmData->validate();

            $_domainTemplateConfirmd = $this->_domainTemplateConfirm->confirm_DomainTemplate($_domainTemplateConfirmData);

            $result = [
                'success' => $_domainTemplateConfirmd
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
