<?php
declare(strict_types=1);
require __DIR__.'/../vendor/autoload.php';

use \App\Commands\CrawlerWorker;

$worker = new CrawlerWorker();
$worker->fire();





























?>
