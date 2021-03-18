<?php
declare(strict_types=1);
/**
 * Date: 12.02.21
 * Time: 22:27
 */
namespace App\CrawlerWorker;

use App\CrawlerWorker\Abstracts\BaseCrawler;

/**
 * Crawler based on browser driver, aimed to perform complex emulation activity
 *
 * Class BrowserDriverPerformer
 * @package App\CrawlerWorker
 */
class BrowserDriverPerformer extends BaseCrawler
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
