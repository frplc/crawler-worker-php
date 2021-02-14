<?php
/**
 * Date: 13.02.21
 * Time: 22:55
 */
namespace App\CrawlerWorker;

use App\CrawlerWorker\Abstracts\BaseResponseHandler;
use App\CrawlerWorker\Interfaces\CrawlerWorker;
use App\CrawlerWorker\Interfaces\ResponseHandler;

class LinksDigger extends BaseResponseHandler implements ResponseHandler
{

    /**
     * LinksDigger constructor.
     * @param CrawlerWorker $crawler
     */
    public function __construct(CrawlerWorker $crawler)
    {
        parent::__construct($crawler);
    }

    /**
     * @inheritdoc
     */
    public function handleSuccessfulResponse(): void
    {
        $this->dig();
    }



    /**
     * Recursively dig links depends on task's parameters
     */
    public function dig()
    {
        // actions before recursive crawl

        // crawl

        // actions after recursive crawl
    }
}
