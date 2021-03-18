<?php
declare(strict_types=1);
/**
 * Date: 13.02.21
 * Time: 23:20
 */
namespace App\CrawlerWorker\Abstracts;

use App\CrawlerWorker\Interfaces\CrawlerDto;
use App\CrawlerWorker\Interfaces\Crawler;

abstract class BaseResponseHandler
{
    /**
     * @var Crawler
     */
    protected crawler $crawler;

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
