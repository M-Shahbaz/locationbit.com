<?php

namespace App\Domain\Location\Service;

use App\Domain\Location\Data\LocationTicketCreateData;
use App\Domain\Location\Repository\LocationTicketCreatorRepository;

/**
 * Service.
 */
final class LocationTicketCreator
{
    private $repository;

    public function __construct(LocationTicketCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createLocationTicket(LocationTicketCreateData $locationTicketCreateData): Int
    {
        $newLocationTicketId = $this->repository->insertLocationTicket($locationTicketCreateData);
        return $newLocationTicketId;
    }
}