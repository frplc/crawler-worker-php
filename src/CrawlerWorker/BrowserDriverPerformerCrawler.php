<?php
declare(strict_types=1);
/**
 * Date: 12.02.21
 * Time: 22:27
 */
namespace App\CrawlerWorker;

use App\CrawlerWorker\Abstracts\BaseCrawlerWorker;

/**
 * Crawler based on browser driver, aimed to perform complex emulation activity
 *
 * Class BrowserDriverPerformerCrawler
 * @package App\CrawlerWorker
 */
class BrowserDriverPerformerCrawler extends BaseCrawlerWorker
{

    /**
     * @inheritdoc
     */
    public function crawl(): void
    {
        // crawl
    }

    /**
     * @inheritdoc
     */
    public function performActionsAfterCrawl(): void
    {
        // perform
    }

}
