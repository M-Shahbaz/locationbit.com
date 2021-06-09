<?php

namespace App\Domain\_Domain\Repository;

use App\Domain\_Domain\Data\_DomainTemplateUpdateData;
use DomainException;
use Illuminate\Database\Connection;

/**
 * Repository.
 */
class _DomainTemplateUpdateRepository
{
    /**
     * @var connection Eloquent The database connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function update_DomainTemplate(Array $_domainTemplateUpdateArray,  _DomainTemplateUpdateData $_domainTemplateUpdateData): Bool
    {

        $row = $_domainTemplateUpdateArray;
        
        try {
            $numberOfaffectedRows = $this->connection->table('_domain_table')
                             ->where('id', $_domainTemplateUpdateData->id)
                             ->where('createdBy', $_domainTemplateUpdateData->updatedBy)
                             ->whereNull('deletedOn')
                             ->update($row);

            return $numberOfaffectedRows;
            
        } catch (\Throwable $th) {
            throw new DomainException($th->getMessage()) ;
        }
        
        return false;
    }

}
