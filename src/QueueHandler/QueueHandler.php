<?php
declare(strict_types=1);
/**
 * Date: 13.02.21
 * Time: 1:11
 */
namespace App\QueueHandler;

use App\Interfaces\TaskDto;
use App\Inventory\CommonConsts;
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
        // Stub data
        return "";
    }

    protected function convertMessageToTaskDto(string $message): TaskDto
    {
        //Stub data
        $taskDto = new \App\Inventory\TaskDto();

        $taskDto->setCrawlerType("PLAIN_DOWNLOADER");
        $taskDto->setConcurrencyValue(10);

        $options = new \StdClass();
        $options->debug = true;
        $headers = [
            'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36',
            "Accept" => "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8",
            "Accept-encoding" => "gzip, deflate, br",
            "Accept-language" => "en,ru;q=0.9,it;q=0.8,en-US;q=0.7",
            "Cache-control" => "no-cache",
        ];
        $options->headers = $headers;
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
        $taskDto->setFileSavingPath(CommonConsts::STORAGE_DIR_PATH."files");

        return $taskDto;
    }
}
