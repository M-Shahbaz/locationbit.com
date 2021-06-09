<?php

namespace App\Domain\_Domain\Repository;

use App\Domain\_Domain\Data\_DomainTemplateCreateData;
use Illuminate\Database\Connection;

/**
 * Repository.
 */
class _DomainTemplateCreatorRepository
{
    /**
     * @var connection Eloquent The database connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
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

        $insId = (int)$this->connection->table('_domain_table')->insertGetId($row);
        return $insId;
    }

}
