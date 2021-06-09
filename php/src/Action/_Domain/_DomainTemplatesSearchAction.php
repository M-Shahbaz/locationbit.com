<?php

namespace App\Action\_Domain;

use App\Domain\_Domain\Data\_DomainTemplatesSearchData;
use App\Domain\_Domain\Service\_DomainTemplatesSearch;
use App\Utility\CastService;
use DomainException;
use LogicException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use UnexpectedValueException;

final class _DomainTemplatesSearchAction
{
    private $_domainTemplatesSearch;
    private $loggerInterface;

    public function __construct(
        _DomainTemplatesSearch $_domainTemplatesSearch,
        LoggerInterface $loggerInterface
    ) {
        $this->_domainTemplatesSearch = $_domainTemplatesSearch;
        $this->loggerInterface = $loggerInterface;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $jwtUserData = CastService::castJwtUserData($request->getAttribute('jwtUserData'));

        $data = (array)$request->getParsedBody();

        $page = isset($args['page']) ? $args['page'] : 1;
        $limit = isset($args['limit']) ? $args['limit'] : 10;
        $offset = --$page * $limit;

        $_domainTemplatesSearchData = new _DomainTemplatesSearchData();
        $_domainTemplatesSearchData->from = isset($data['from']) ? date('Y-m-d H:i:s', strtotime($data['from'])) : NULL;
        $_domainTemplatesSearchData->to = isset($data['to']) ? date('Y-m-d H:i:s', strtotime($data['to'])) : NULL;
        $_domainTemplatesSearchData->userIds[] = $jwtUserData->uid;
        $_domainTemplatesSearchData->limit = $limit;
        $_domainTemplatesSearchData->offset = $offset;


        try {

            //Throwing excemption
            $_domainTemplatesSearchData->validate();

            $_domainTemplatesSearch = $this->_domainTemplatesSearch->search_DomainTemplates($_domainTemplatesSearchData);

            $result = $_domainTemplatesSearch;
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
