<?php

namespace App\Domain\_Domain\Repository;

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

    public function get_DomainTemplate(): array
    {

        try {
            $rows = $this->connection
                ->table('_domain_table')
                ->get()
                ->toArray();
        } catch (\Throwable $th) {
            throw new DomainException($th->getMessage());
        }

        return $rows;
    }
}
