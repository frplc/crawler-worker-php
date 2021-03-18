<?php
declare(strict_types=1);
/**
 * Date: 12.02.21
 * Time: 23:22
 */
namespace App\Commands;

use App\Adjutants\LogAdjutant;
use App\CrawlerWorker\CrawlerFactory;
use App\Interfaces\TaskDto;
use App\Inventory\CommonConsts;
use App\QueueHandler\QueueHandler;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class CrawlerWorkerCommand
{

    protected Logger $logger;

    public function __construct()
    {
        $this->configureLogger();
    }

    public function handle(): void
    {
        try {
            $this->logger->info("Start worker");

            $taskDto = $this->resolveTask();
            $this->crawl($taskDto);

            $this->logger->info("Finish worker");
        } catch (\Throwable $e) {
            $this->logger->critical(LogAdjutant::makeLogMessage($e));
        }
    }

    protected function resolveTask(): TaskDto
    {
//        $queueHandler = new QueueHandler();
//        return $queueHandler->retrieveTask();

          return $this->makeExampleTask();
    }

    protected function crawl(TaskDto $taskDto): void
    {
        $crawler = CrawlerFactory::makeCrawler($taskDto->getCrawlerType());

        $crawler->setLogger($this->logger);
        $crawler->setTaskDto($taskDto);
        $crawler->configure();

        $crawler->crawl();

        $crawler->performActionsAfterCrawl();
    }

    protected function configureLogger(): void
    {
        $date = (new \DateTime())->format("Y_m_d");
        $logger = new Logger("crawler-worker-php");
        $logger->pushHandler(new StreamHandler(CommonConsts::STORAGE_DIR_PATH
            ."logs/log_".$date, Logger::DEBUG));
        $this->logger = $logger;
    }

    protected function makeExampleTask()
    {
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
        $options->timeout = 10.0;
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
