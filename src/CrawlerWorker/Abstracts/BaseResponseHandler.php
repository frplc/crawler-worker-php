<?php
declare(strict_types=1);
/**
 * Date: 13.02.21
 * Time: 23:20
 */
namespace App\CrawlerWorker\Abstracts;

use App\CrawlerWorker\Interfaces\CrawlerDto;
use App\CrawlerWorker\Interfaces\Crawler;
use App\CrawlerWorker\Interfaces\ResponseHandler;

abstract class BaseResponseHandler implements ResponseHandler
{
    /**
     * @var Crawler
     */
    protected Crawler $crawler;

    /**
     * @var CrawlerDto
     */
    protected CrawlerDto $crawlerDto;

    /**
     * {@var ElementsProcessor}
     */
    protected $elementsProcessor;

    /**
     * BaseResponseHandler constructor.
     * @param Crawler $crawler
     */
    public function __construct(Crawler $crawler)
    {
        $this->crawler = $crawler;
    }

    /**
     * @inheritdoc
     */
    public function handleRejectedResponse(): void
    {
        // handle

        $this->crawler->getLogger()->warning("Rejected: ".$this->getRequestInfoAndTaskUUID());
    }

    /**
     * @param CrawlerDto $crawlerDto
     */
    public function setCrawlerDto(CrawlerDto $crawlerDto): void
    {
        $this->crawlerDto = $crawlerDto;
    }

    /**
     * @return CrawlerDto
     */
    public function getCrawlerDto(): CrawlerDto
    {
        return $this->crawlerDto;
    }

    protected function getRequestIndex(): int
    {
        return $this->getCrawlerDto()->getRequestIndex();
    }

    protected function getRequestedUrl()
    {
        return $this->getCrawlerDto()->getRequestedUrl();
    }

    protected function getRequestIndexAndRequestedUrl()
    {
        return "Index: ".$this->getRequestIndex()."| URL: ".$this->getRequestedUrl();
    }

    protected function getTaskUUIDMsg()
    {
        return " | Task uuid ".$this->crawler->getTaskDto()->getTaskUUID();
    }

    protected function getRequestInfoAndTaskUUID()
    {
        return $this->getRequestIndexAndRequestedUrl().$this->getTaskUUIDMsg();
    }

}
