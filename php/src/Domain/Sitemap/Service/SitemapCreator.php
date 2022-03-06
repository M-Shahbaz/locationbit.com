<?php

namespace App\Domain\Sitemap\Service;

use App\Domain\Location\Data\LocationsSearchData;
use App\Domain\Location\Service\LocationsSearch;
use App\Utility\FunctionsService;

/**
 * Service.
 */
final class SitemapCreator
{
    private $locationsSearch;

    public function __construct(LocationsSearch $locationsSearch)
    {
        $this->locationsSearch = $locationsSearch;
    }

    public function createSitemap()
    {

        // FunctionsService::noTimeAndMemoryLimit();

        $yourSiteUrl = 'https://locationbit.com';
        $outputDir = TEMP_FOLDER;

        $generator = new \Icamys\SitemapGenerator\SitemapGenerator($yourSiteUrl, $outputDir);

        // Create a compressed sitemap
        $generator->enableCompression();

        // Determine how many urls should be put into one file;
        // this feature is useful in case if you have too large urls
        // and your sitemap is out of allowed size (50Mb)
        // according to the standard protocol 50000 urls per sitemap
        // is the maximum allowed value (see http://www.sitemaps.org/protocol.html)
        $generator->setMaxUrlsPerSitemap(50000);

        // Set the sitemap file name
        $generator->setSitemapFileName("sitemap.xml");

        // Set the sitemap index file name
        $generator->setSitemapIndexFileName("sitemap-index.xml");

        $generator->addURL("/");
        $generator->addURL("/country");
        $generator->addURL("/search?q=Pakistan");


        $locationsSearchData = new LocationsSearchData();
        $locationsSearchData->limit = 10000;
        $locationsSearchData->offset = 0;

        $locationsSearch = $this->locationsSearch->allLocations($locationsSearchData);

        while (isset($locationsSearch['results']) && !empty($locationsSearch['results'])) {

            foreach ($locationsSearch['results'] as $key => $row) {
                // if (strpos($row->id, '/') !== false) {
                //     var_dump($row);
                //     exit;
                // }                
                $generator->addURL("/location/" . ($row->id) . "/" . ($row->slug));
            }

            $scroll_id = $locationsSearch['_scroll_id'];

            $locationsSearch = $this->locationsSearch->scroll($scroll_id);
        }

        // Flush all stored urls from memory to the disk and close all necessary tags.
        $generator->flush();

        // Move flushed files to their final location. Compress if the option is enabled.
        $generator->finalize();

        // Update robots.txt file in output directory or create a new one
        $generator->updateRobots();
    }
}
