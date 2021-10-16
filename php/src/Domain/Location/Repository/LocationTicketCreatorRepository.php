<?php

namespace App\Domain\Location\Repository;

use App\Domain\Location\Data\LocationTicketCreateData;
use Illuminate\Database\Connection;

/**
 * Repository.
 */
class LocationTicketCreatorRepository
{
    /**
     * @var connection Eloquent The database connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function insertLocationTicket(LocationTicketCreateData $locationTicketCreateData): Int
    {

        $row = [
            'locationId' => $locationTicketCreateData->locationId,
            'userId' => $locationTicketCreateData->userId,
            'field' => $locationTicketCreateData->field,
            'status' => $locationTicketCreateData->status,
            'tickets' => $locationTicketCreateData->tickets,
            'createdBy' => $locationTicketCreateData->createdBy,
        ];

        $insId = (int)$this->connection->table('location_tickets')->insertGetId($row);
        return $insId;
    }

}
