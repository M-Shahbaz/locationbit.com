<?php

namespace App\Domain\_Domain\Repository;

use App\Domain\_Domain\Data\_DomainTemplateData;
use App\Domain\_Domain\Data\_DomainTemplateReadRequestData;
use DomainException;
use Elasticsearch\Client;

/**
 * Repository.
 */
class _DomainTemplateReaderRepository
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function get_DomainTemplateById(_DomainTemplateReadRequestData $_domainTemplateReadRequestData): _DomainTemplateData
    {

        $params = [
            'index' => '_domain_index',
            'id'    => 'id'
        ];

        try {
            $row = (object)$this->client->getSource($params);
        } catch (\Throwable $th) {
            throw new DomainException(sprintf('_DomainTemplate not found by id: %s', $_domainTemplateReadRequestData->_domainTemplateId));
        }

        $_domainTemplateData = new _DomainTemplateData();
        $_domainTemplateData->id = (int)$row->id;
        $_domainTemplateData->dataKey = (string)$row->dataKey;
        $_domainTemplateData->dataValue = (string)$row->dataValue;
        $_domainTemplateData->createdOn = (string)$row->createdOn;

        return $_domainTemplateData;
    }
}
