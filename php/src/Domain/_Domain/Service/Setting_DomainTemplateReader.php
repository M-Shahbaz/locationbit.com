<?php

namespace App\Domain\_Domain\Service;

use App\Domain\_Domain\Repository\_DomainTemplateReaderRepository;
use UnexpectedValueException;

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

    public function get_DomainTemplate(): array
    {
        
        $_domainTemplateData = $this->repository->get_DomainTemplate();
        return $_domainTemplateData;
    }
}