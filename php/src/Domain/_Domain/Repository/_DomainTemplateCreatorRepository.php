<?php

namespace App\Domain\_Domain\Repository;

use App\Domain\_Domain\Data\_DomainTemplateCreateData;
use Elasticsearch\Client;

/**
 * Repository.
 */
class _DomainTemplateCreatorRepository
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function insert_DomainTemplate(_DomainTemplateCreateData $_domainTemplateCreateData): Int
    {

        $row = [
            'title' => $_domainTemplateCreateData->title,
            'location' => $_domainTemplateCreateData->location,
            'start' => $_domainTemplateCreateData->start,
            'end' => $_domainTemplateCreateData->end,
            'leadId' => $_domainTemplateCreateData->leadId,
            'customerId' => $_domainTemplateCreateData->customerId,
            'sourceId' => $_domainTemplateCreateData->sourceId,
            'feedbackId' => $_domainTemplateCreateData->feedbackId,
            'createdBy' => $_domainTemplateCreateData->createdBy,
        ];


        $params = [
            'index' => '_domain_index',
            'body'  => $row
        ];

        $response = $this->client->index($params);
        return $response['_id'];
    }
}
