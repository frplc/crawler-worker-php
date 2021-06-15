<?php
declare(strict_types=1);
/**
 * Date: 12.02.21
 * Time: 23:24
 */
namespace App\CrawlerWorker;

use App\CrawlerWorker\Interfaces\Crawler;
use App\CrawlerWorker\Inventory\CrawlerConsts;

class CrawlerFactory
{
    /**
     * @param string $crawlerType
     * @return Crawler
     */
    public static function makeCrawler(string $crawlerType): Crawler
    {
        switch ($crawlerType) {
            case CrawlerConsts::PLAIN_DOWNLOADER:
                $crawler = new PlainDownloader();
                break;
            case CrawlerConsts::BROWSER_DRIVER_PERFORMER:
                $crawler = new BrowserDriverPerformer();
                break;
            default:
                throw new \InvalidArgumentException("Unknown crawler type");
        }
        return $crawler;
    }

}
