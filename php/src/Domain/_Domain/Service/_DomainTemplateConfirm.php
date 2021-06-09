<?php

namespace App\Domain\_Domain\Service;

use App\Domain\_Domain\Data\_DomainTemplateConfirmData;
use App\Domain\_Domain\Repository\_DomainTemplateConfirmRepository;

/**
 * Service.
 */
final class _DomainTemplateConfirm
{
    private $repository;

    public function __construct(_DomainTemplateConfirmRepository $repository)
    {
        $this->repository = $repository;
    }

    public function confirm_DomainTemplate(_DomainTemplateConfirmData $_domainTemplateConfirmData): Bool
    {
        $_domainTemplateConfirmd = $this->repository->confirm_DomainTemplate($_domainTemplateConfirmData);
        return $_domainTemplateConfirmd;
    }
}