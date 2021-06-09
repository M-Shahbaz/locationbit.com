<?php

namespace App\Domain\_Domain\Repository;

use App\Domain\_Domain\Data\_DomainTemplatesSearchData;
use DomainException;
use Illuminate\Database\Connection;

/**
 * Repository.
 */
class _DomainTemplatesSearchRepository
{
    /**
     * @var connection Eloquent The database connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function search_DomainTemplates(_DomainTemplatesSearchData $filter): Array
    {

        try {
            $rows = $this->connection
                        ->table('_domain_table')
                        ->whereNull('deletedOn')
                        ->whereIn('createdBy', $filter->userIds)
                        ->when(!empty($filter->from) && !empty($filter->to), function(\Illuminate\Database\Query\Builder $q) use($filter){
                            $q->whereBetween('start', [$filter->from, $filter->to]);
                        })
                        ->orderBy('_domain_table.id', 'DESC')
                        ->limit((int)$filter->limit)
                        ->offset((int)$filter->offset)
                        ->get()
                        ->toArray();

        } catch (\Throwable $th) {
            throw new DomainException($th->getMessage());
        }
     
        return $rows;
    }

    
    
    public function getTotalResultCount(): ?int
    {

        try {
            $row = $this->connection
                        ->select($this->connection->raw("SELECT FOUND_ROWS() AS TotalResultCount;"))[0]->TotalResultCount;

        } catch (\Throwable $th) {
            throw new DomainException($th->getMessage());
        }
     
        return $row;
    }

}
