<?php

namespace App\Domain\Location\Repository;

use App\Domain\Location\Data\LocationHistoryData;
use App\Domain\Location\Data\LocationHistoryReadRequestData;
use Carbon\Carbon;
use DomainException;
use Illuminate\Database\Connection;

/**
 * Repository.
 */
class LocationHistoryReaderRepository
{
    /**
     * @var connection Eloquent The database connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function countApiLogsLimitPerMinute(string $userId, ?int $limitPerMinute)
    {

        try {
            return $this->connection
                        ->table('location_history')
                        ->where('location_history.createdBy', $userId)
                        ->whereBetween('createdOn', [Carbon::now()->subMinute(), Carbon::now()])
                        ->groupBy('location_history.createdBy')
                        ->havingRaw("COUNT(createdBy) > ? ", [
                            $limitPerMinute
                        ])
                        ->count();

        } catch (\Throwable $th) {
            throw new DomainException($th->getMessage());
        }
     
    }


}
