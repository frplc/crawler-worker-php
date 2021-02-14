<?php
declare(strict_types=1);
/**
 * Date: 12.02.21
 * Time: 23:22
 */
namespace App\Commands;

use App\Adjutants\LogAdjutant;
use App\CrawlerWorker\CrawlerFactory;
use App\CrawlerWorker\Interfaces\TaskDto;
use App\CrawlerWorker\QueueHandler;
use App\Inventory\CrawlerWorkerConsts;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class CrawlerWorkerCommand
{

    protected Logger $logger;

    public function __construct()
    {
        $this->configureLogger();
    }

    public function fire(): void
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
        $queueHandler = new QueueHandler();
        return $queueHandler->retrieveTask();
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
        $logger->pushHandler(new StreamHandler(CrawlerWorkerConsts::STORAGE_DIR_PATH
            ."logs/log_".$date, Logger::DEBUG));
        $this->logger = $logger;
    }

}
