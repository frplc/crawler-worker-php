<?php
declare(strict_types=1);
/**
 * Date: 12.02.21
 * Time: 22:24
 */
namespace App\CrawlerWorker\Abstracts;

use App\CrawlerWorker\Interfaces\Crawler;
use App\Interfaces\TaskDto;
use Monolog\Logger;

abstract class BaseCrawler implements Crawler
{
    /**
     * @var TaskDto
     */
    protected TaskDto $taskDto;

    /**
     * @var int
     */
    protected int $successfulRequestsQuantity = 0;

    /**
     * @var int
     */
    protected int $rejectedRequestsQuantity = 0;

    /**
     * @var Logger
     */
    protected Logger $logger;

    /**
     *{@var ClientAdapter}
     */
    protected $client;

    /**
     * {@var RequestsOptionsAdapter}
     */
    protected $requestsOptions;

    /**
     * Initialize common crawler params and settings based on TaskDto data
     */
    public function configure(): void
    {
        // configure
    }

    /**
     * @inheritdoc
     */
    public function performActionsAfterCrawl(): void
    {
        // perform
    }

    /**
     * @param TaskDto $taskDto
     */
    public function setTaskDto(TaskDto $taskDto): void
    {
        $this->taskDto = $taskDto;
    }

    /**
     * @param Logger $logger
     */
    public function setLogger(Logger $logger): void
    {
        $this->logger = $logger;
    }

    /**
     * @return int
     */
    public function getSuccessfulRequestsQuantity(): int
    {
        return $this->successfulRequestsQuantity;
    }

    /**
     * @return int
     */
    public function getRejectedRequestsQuantity(): int
    {
        return $this->rejectedRequestsQuantity;
    }

    /**
     * @return TaskDto
     */
    public function getTaskDto(): TaskDto
    {
        return $this->taskDto;
    }

    /**
     * @return Logger
     */
    public function getLogger(): Logger
    {
        return $this->logger;
    }

}
