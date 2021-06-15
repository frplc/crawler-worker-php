<?php
declare(strict_types=1);
/**
 * Date: 13.02.21
 * Time: 23:05
 */
namespace App\CrawlerWorker;

use App\CrawlerWorker\Interfaces\Crawler;
use App\CrawlerWorker\Interfaces\ResponseHandler;
use App\CrawlerWorker\Inventory\CrawlerConsts;

class ResponseHandlerFactory
{
    /**
     * @param Crawler $currentCrawler
     * @return ResponseHandler
     */
    public static function makeResponseHandler(Crawler $currentCrawler): ResponseHandler
    {
        switch($currentCrawler->getTaskDto()->getResponseHandlerType()) {
            case CrawlerConsts::LINKS_HANDLER:
                $handler = new LinksHandler($currentCrawler);
                break;
            case CrawlerConsts::FILES_HANDLER:
                $handler = new FilesHandler($currentCrawler);
                break;
            default:
                throw new \InvalidArgumentException("Unknown response handler type");
        }
        return $handler;
    }

}
