<?php
declare(strict_types=1);
/**
 * Date: 13.02.21
 * Time: 1:11
 */
namespace App\QueueHandler;

use App\Interfaces\TaskDto;
use App\ServiceDiscovery\ServiceDiscovery;

class QueueHandler
{

    /**
     * @var ServiceDiscovery
     */
    protected ServiceDiscovery $serviceDiscovery;

    /**
     * @var string
     */
    protected $crawlerQueueUrl;

    public function __construct()
    {
        $this->serviceDiscovery = new ServiceDiscovery();
        $this->initCrawlerQueueUrl();
    }

    protected function initCrawlerQueueUrl(): void
    {
        $this->crawlerQueueUrl = $this->serviceDiscovery->getCrawlerQueueUrl();
    }

    /**
     * Connect to queue, get message, convert to TaskDto
     *
     * @return TaskDto
     */
    public function retrieveTask(): TaskDto
    {
        $this->connectToQueue();
        return $this->convertMessageToTaskDto($this->getMessage());
    }

    protected function connectToQueue(): void
    {
        // connect
    }

    protected function getMessage(): string
    {
        $msg = "";

        // Get message from queue

        return $msg;
    }

    protected function convertMessageToTaskDto(string $message): TaskDto
    {
        $taskDto = new \App\Inventory\TaskDto();

        // convert msg to TaskDto

        return $taskDto;
    }
}
