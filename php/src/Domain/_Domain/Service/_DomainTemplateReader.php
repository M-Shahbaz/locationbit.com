<?php

namespace App\Domain\_Domain\Service;

use App\Domain\_Domain\Data\_DomainTemplateData;
use App\Domain\_Domain\Data\_DomainTemplateReadRequestData;
use App\Domain\_Domain\Repository\_DomainTemplateReaderRepository;

/**
 * Service.
 */
final class _DomainTemplateReader
{
    private $repository;

    public function __construct(_DomainTemplateReaderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get_DomainTemplateById(_DomainTemplateReadRequestData $_domainTemplateReadRequestData): _DomainTemplateData
    {
        
        $_domainTemplateData = $this->repository->get_DomainTemplateById($_domainTemplateReadRequestData);
        return $_domainTemplateData;
    }
}