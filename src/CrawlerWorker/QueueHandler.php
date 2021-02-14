<?php
declare(strict_types=1);
/**
 * Date: 13.02.21
 * Time: 1:11
 */
namespace App\CrawlerWorker;

use App\CrawlerWorker\Interfaces\TaskDto;
use App\Inventory\CrawlerWorkerConsts;

class QueueHandler
{

    /**
     * @var ServiceDiscovery
     */
    protected $serviceDiscovery;

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
        // Stub data
        return "";
    }

    protected function convertMessageToTaskDto(string $message): TaskDto
    {
        //Stub data
        $taskDto = new \App\CrawlerWorker\Inventory\TaskDto();

        $taskDto->setCrawlerType("PLAIN_DOWNLOADER");
        $taskDto->setConcurrencyValue(10);

        $options = new \StdClass();
        $options->debug = true;
        $taskDto->setOptions($options);

        $taskDto->setUrls([
            'https://testimgs.s3.eu-west-3.amazonaws.com/white_10_10.jpg',
            'https://wikipedia.org',
            'https://testimgs.s3.eu-west-3.amazonaws.com/white_10_10.jpg',
            'https://testimgs.s3.eu-west-3.amazonaws.com/white_10_10.jpg',
            'https://testimgs.s3.eu-west-3.amazonaws.com/white_10_10.jpg',
            'https://testimgs.s3.eu-west-3.amazonaws.com/white_10_10.jpg',
            'https://testimgs.s3.eu-west-3.amazonaws.com/white_10_10.jpg',
            'https://testimgs.s3.eu-west-3.amazonaws.com/white_10_10.jpg',
            'https://testimgs.s3.eu-west-3.amazonaws.com/white_10_10.jpg',
            'https://testimgs.s3.eu-west-3.amazonaws.com/white_10_10.jpg',
            'https://testimgs.s3.eu-west-3.amazonaws.com/white_10_10.jpg',
            'https://testimgs.s3.eu-west-3.amazonaws.com/white_10_10.jpg',
            'https://testimgs.s3.eu-west-3.amazonaws.com/white_10_10.jpg',
            'https://testimgs.s3.eu-west-3.amazonaws.com/white_10_10.jpg',
            'https://testimgs.s3.eu-west-3.amazonaws.com/white_10_10.jpg',
            'https://testimgs.s3.eu-west-3.amazonaws.com/white_10_10.jpg',
            'https://testimgs.s3.eu-west-3.amazonaws.com/white_10_10.jpg',
            'https://testimgs.s3.eu-west-3.amazonaws.com/white_10_10.jpg',
            'https://testimgs.s3.eu-west-3.amazonaws.com/white_10_10.jpg',
            'https://testimgs.s3.eu-west-3.amazonaws.com/white_10_10.jpg',
            'https://testimgs.s3.eu-west-3.amazonaws.com/white_10_10.jpg',
        ]);

        $taskDto->setResponseHandlerType("FILES_HANDLER");
        $taskDto->setFileSavingPath(CrawlerWorkerConsts::STORAGE_DIR_PATH."files");

        return $taskDto;
    }
}
