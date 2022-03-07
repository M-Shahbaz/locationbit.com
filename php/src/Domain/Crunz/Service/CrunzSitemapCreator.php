<?php

namespace App\Domain\Crunz\Service;

use App\Domain\Sitemap\Service\SitemapCreator;
use App\Utility\FunctionsService;

/**
 * Service.
 */
final class CrunzSitemapCreator
{
    private $sitemapCreator;

    public function __construct(SitemapCreator $sitemapCreator)
    {
        $this->sitemapCreator = $sitemapCreator;
    }

    public function sitemapCreator()
    {
        FunctionsService::noTimeAndMemoryLimit();
        $this->sitemapCreator->createSitemap();
    }
}