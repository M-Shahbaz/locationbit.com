<?php

namespace App\Domain\_Domain\Service;

use App\Domain\_Domain\Data\_DomainTemplateDeleteData;
use App\Domain\_Domain\Repository\_DomainTemplateDeleteRepository;

/**
 * Service.
 */
final class _DomainTemplateDelete
{
    private $repository;

    public function __construct(_DomainTemplateDeleteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function delete_DomainTemplate(_DomainTemplateDeleteData $_domainTemplateDeleteData): Bool
    {
        $_domainTemplateDeleted = $this->repository->delete_DomainTemplate($_domainTemplateDeleteData);
        return $_domainTemplateDeleted;
    }
}