<?php

namespace App\Domain\_Domain\Service;

use App\Domain\_Domain\Data\_DomainTemplateCreateData;
use App\Domain\_Domain\Repository\_DomainTemplateCreatorRepository;

/**
 * Service.
 */
final class _DomainTemplateCreator
{
    private $repository;

    public function __construct(_DomainTemplateCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create_DomainTemplate(_DomainTemplateCreateData $_domainTemplateCreateData): Int
    {
        $new_DomainTemplateId = $this->repository->insert_DomainTemplate($_domainTemplateCreateData);
        return $new_DomainTemplateId;
    }
}