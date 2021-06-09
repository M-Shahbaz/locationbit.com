<?php

namespace App\Domain\_Domain\Repository;

use App\Domain\_Domain\Data\_DomainTemplateDeleteData;
use DomainException;
use Illuminate\Database\Connection;

/**
 * Repository.
 */
class _DomainTemplateDeleteRepository
{
    /**
     * @var connection Eloquent The database connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function delete_DomainTemplate(_DomainTemplateDeleteData $_domainTemplateDeleteData): Bool
    {

        $row = [
            'deletedOn' => date('Y-m-d H:i:s'),
            'deletedBy' => $_domainTemplateDeleteData->deletedBy
        ];

        
        try {
            $numberOfaffectedRows = $this->connection->table('_domain_table')
                             ->where('id', $_domainTemplateDeleteData->id)
                             ->where('createdBy', $_domainTemplateDeleteData->deletedBy)
                             ->whereNull('deletedOn')
                             ->update($row);

            return $numberOfaffectedRows;
            
        } catch (\Throwable $th) {
            throw new DomainException($th->getMessage()) ;
        }
        return false;
    }

}
