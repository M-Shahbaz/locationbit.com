<?php

declare(strict_types=1);

use Crunz\Schedule;
use Selective\Config\Configuration;
use App\Domain\Crunz\Service\CrunzSitemapCreator;


$schedule = new Schedule();

$task = $schedule->run(function () {

    $app = (require __DIR__ . '/../config/bootstrap.php');
    $container = $app->getContainer();
    
    $configuration = $container->get(Configuration::class);

    $castClass = function (CrunzSitemapCreator $crunzSitemapCreator)
    {
        $crunzSitemapCreator->sitemapCreator();
    };

    $castClass(
        $container->get(CrunzSitemapCreator::class)
    );
});


$task->description('CrunzSitemapCreator')->on('18:53 2022-03-07');

return $schedule;
