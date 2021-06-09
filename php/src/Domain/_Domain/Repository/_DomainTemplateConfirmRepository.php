<?php

namespace App\Domain\_Domain\Repository;

use App\Domain\_Domain\Data\_DomainTemplateConfirmData;
use DomainException;
use Illuminate\Database\Connection;

/**
 * Repository.
 */
class _DomainTemplateConfirmRepository
{
    /**
     * @var connection Eloquent The database connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function confirm_DomainTemplate(_DomainTemplateConfirmData $_domainTemplateConfirmData): Bool
    {

        $row = [
            'confirmdOn' => date('Y-m-d H:i:s'),
            'updatedBy' => $_domainTemplateConfirmData->updatedBy
        ];

        
        try {
            $numberOfaffectedRows = $this->connection->table('_domain_table')
                             ->where('id', $_domainTemplateConfirmData->id)
                             ->whereNull('deletedOn')
                             ->update($row);

            return $numberOfaffectedRows;
            
        } catch (\Throwable $th) {
            throw new DomainException($th->getMessage()) ;
        }
        return false;
    }

}
