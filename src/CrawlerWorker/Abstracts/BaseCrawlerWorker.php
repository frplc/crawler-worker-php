<?php
declare(strict_types=1);
/**
 * Date: 12.02.21
 * Time: 22:24
 */
namespace App\CrawlerWorker\Abstracts;

use App\CrawlerWorker\Interfaces\CrawlerWorker;
use App\CrawlerWorker\Interfaces\TaskDto;
use Monolog\Logger;

abstract class BaseCrawlerWorker implements CrawlerWorker
{
    /**
     * @var TaskDto
     */
    protected TaskDto $taskDto;

    /**
     * @var int
     */
    protected int $successfulRequestsQuantity;

    /**
     * @var int
     */
    protected int $rejectedRequestsQuantity;

    /**
     * @var Logger
     */
    protected Logger $logger;

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
     * @param int $successfulRequestsQuantity
     */
    public function setSuccessfulRequestsQuantity(int $successfulRequestsQuantity): void
    {
        $this->successfulRequestsQuantity = $successfulRequestsQuantity;
    }

    /**
     * @param int $rejectedRequestsQuantity
     */
    public function setRejectedRequestsQuantity(int $rejectedRequestsQuantity): void
    {
        $this->rejectedRequestsQuantity = $rejectedRequestsQuantity;
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
