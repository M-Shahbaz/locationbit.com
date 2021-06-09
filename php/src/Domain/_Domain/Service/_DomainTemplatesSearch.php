<?php

namespace App\Domain\_Domain\Service;

use App\Domain\_Domain\Data\_DomainTemplatesSearchData;
use App\Domain\_Domain\Repository\_DomainTemplatesSearchRepository;

/**
 * Service.
 */
final class _DomainTemplatesSearch
{
    private $repository;

    public function __construct(_DomainTemplatesSearchRepository $repository)
    {
        $this->repository = $repository;
    }

    public function search_DomainTemplates(_DomainTemplatesSearchData $_domainTemplatesSearchData): Array
    {
        $_domainTemplatesSearch = $this->repository->search_DomainTemplates($_domainTemplatesSearchData);
        return $_domainTemplatesSearch;
    }
}