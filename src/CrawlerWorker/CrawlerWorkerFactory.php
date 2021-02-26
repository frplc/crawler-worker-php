<?php
declare(strict_types=1);
/**
 * Date: 12.02.21
 * Time: 23:24
 */
namespace App\CrawlerWorker;

use App\CrawlerWorker\Interfaces\CrawlerWorker;

class CrawlerWorkerFactory
{
    /**
     * @param string $crawlerType
     * @return CrawlerWorker
     */
    public static function makeCrawler(string $crawlerType): CrawlerWorker
    {
        switch ($crawlerType) {
            case "PLAIN_DOWNLOADER":
                $crawler = new PlainDownloaderCrawler();
                break;
            case "BROWSER_DRIVER_PERFORMER":
                $crawler = new BrowserDriverPerformerCrawler();
                break;
            default:
                throw new \InvalidArgumentException("Unknown crawler type");
        }
        return $crawler;
    }

}
