<?php

namespace App\Domain\_Domain\Repository;

use App\Domain\_Domain\Data\_DomainTemplateUpdateData;
use Elasticsearch\Client;

/**
 * Repository.
 */
class _DomainTemplateUpdateRepository
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function insert_DomainTemplate(Array $_domainTemplateUpdateArray,  _DomainTemplateUpdateData $_domainTemplateUpdateData): string
    {

        $row = $_domainTemplateUpdateArray;


        $params = [
            'index' => '_domain_index',
            'id'    => $_domainTemplateUpdateData->id,
            'body'  => [
                'doc' => $row
            ]
        ];

        $response = $this->client->update($params);
        return $response['result'];
    }
}
