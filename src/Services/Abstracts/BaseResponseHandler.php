<?php
/**
 * Date: 13.02.21
 * Time: 23:20
 */
namespace App\Services\Abstracts;

use App\Services\Interfaces\CrawlerDto;
use App\Services\Interfaces\CrawlerWorker;


abstract class BaseResponseHandler
{
    /**
     * @var CrawlerWorker
     */
    protected $crawler;

    /**
     * @var CrawlerDto
     */
    protected $crawlerDto;

    /**
     * BaseResponseHandler constructor.
     * @param CrawlerWorker $crawler
     */
    public function __construct(CrawlerWorker $crawler)
    {
        $this->crawler = $crawler;
    }

    /**
     * @inheritdoc
     */
    public function handleRejectedResponse(): void
    {
        // handle
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

}
