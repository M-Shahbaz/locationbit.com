<?php

namespace App\Domain\_Domain\Service;

use App\Domain\_Domain\Data\_DomainTemplateUpdateData;
use App\Domain\_Domain\Repository\_DomainTemplateUpdateRepository;

/**
 * Service.
 */
final class _DomainTemplateUpdate
{
    private $repository;

    public function __construct(_DomainTemplateUpdateRepository $repository)
    {
        $this->repository = $repository;
    }

    public function update_DomainTemplate(_DomainTemplateUpdateData $_domainTemplateUpdateData): Bool
    {
        $_domainTemplateUpdateArray = [];

        if(isset($_domainTemplateUpdateData->title)) {
            $_domainTemplateUpdateArray['title'] = $_domainTemplateUpdateData->title;
        }

        if(isset($_domainTemplateUpdateData->location)) {
            $_domainTemplateUpdateArray['location'] = $_domainTemplateUpdateData->location;
        }

        if(isset($_domainTemplateUpdateData->start)) {
            $_domainTemplateUpdateArray['start'] = $_domainTemplateUpdateData->start;
        }

        if(isset($_domainTemplateUpdateData->end)) {
            $_domainTemplateUpdateArray['end'] = $_domainTemplateUpdateData->end;
        }

        if(isset($_domainTemplateUpdateData->resheduledOn)) {
            $_domainTemplateUpdateArray['resheduledOn'] = $_domainTemplateUpdateData->resheduledOn;
        }

        if(isset($_domainTemplateUpdateData->resheduledBy)) {
            $_domainTemplateUpdateArray['resheduledBy'] = $_domainTemplateUpdateData->resheduledBy;
        }

        if(isset($_domainTemplateUpdateData->updatedBy)) {
            $_domainTemplateUpdateArray['updatedBy'] = $_domainTemplateUpdateData->updatedBy;
        }

        if(!empty($_domainTemplateUpdateArray)) {
            $_domainTemplateUpdated = $this->repository->update_DomainTemplate($_domainTemplateUpdateArray, $_domainTemplateUpdateData);
            return $_domainTemplateUpdated;
        }
        
        return false;
    }
}