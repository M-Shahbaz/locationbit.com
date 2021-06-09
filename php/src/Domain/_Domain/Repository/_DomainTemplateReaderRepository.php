<?php

namespace App\Domain\_Domain\Repository;

use App\Domain\_Domain\Data\_DomainTemplateData;
use App\Domain\_Domain\Data\_DomainTemplateReadRequestData;
use DomainException;
use Illuminate\Database\Connection;

/**
 * Repository.
 */
class _DomainTemplateReaderRepository
{
    /**
     * @var connection Eloquent The database connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function get_DomainTemplateById(_DomainTemplateReadRequestData $_domainTemplateReadRequestData): _DomainTemplateData
    {

        $row = $this->connection
                      ->table('_domain_table')
                      ->select('id', 'dataKey', 'dataValue', 'createdOn')
                      ->where('id', $_domainTemplateReadRequestData->_domainTemplateId)
                      ->first();

        if (!$row) {
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
