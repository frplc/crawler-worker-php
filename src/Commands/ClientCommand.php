<?php
declare(strict_types=1);
/**
 * Date: 12.02.21
 * Time: 23:22
 */
namespace App\Commands;

use App\Adjutants\LogAdjutant;
use App\CrawlerWorker\CrawlerFactory;
use App\CrawlerWorker\Interfaces\Crawler;
use App\Interfaces\TaskDto;
use App\Inventory\CommonConsts;
use App\QueueHandler\QueueHandler;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Ramsey\Uuid\Uuid;

/**
 * Example class of client showing distributed client-worker interaction
 *
 * Class ClientCommand
 * @package App\Commands
 */
class ClientCommand
{

    /**
     * @var Logger
     */
    protected Logger $logger;

    /**
     * @var Crawler
     */
    protected Crawler $crawler;

    /**
     * ClientCommand constructor.
     */
    public function __construct()
    {
        $this->configureLogger();
    }

    /**
     * Handle crawling task
     */
    public function handle(): void
    {
        try {
            $taskDto = $this->resolveTask();
            $this->logger->info("Start worker with task ".$taskDto->getTaskUUID());

            $this->crawl($taskDto);

            $this->logger->info("Finish worker with task ".$taskDto->getTaskUUID());
        } catch (\Throwable $e) {
            $this->logger->critical(LogAdjutant::makeLogMessage($e));
        }
    }

    /**
     * @return TaskDto
     */
    protected function resolveTask(): TaskDto
    {
        //standard usage
//        $queueHandler = new QueueHandler();
//        return $queueHandler->retrieveTask();

        //example resolving
          return $this->makeExampleTask();
    }

    /**
     * @param TaskDto $taskDto
     */
    protected function crawl(TaskDto $taskDto): void
    {
        $crawler = $this->crawler = CrawlerFactory::makeCrawler($taskDto->getCrawlerType());
        $crawler->setLogger($this->logger);
        $crawler->setTaskDto($taskDto);
        $crawler->configure();

        $crawler->crawl();

        $crawler->performActionsAfterCrawl();
    }

    /**
     * Configure logger
     */
    protected function configureLogger(): void
    {
        $date = (new \DateTime())->format("Y_m_d");
        $logger = new Logger("crawler-worker-php");
        $logger->pushHandler(new StreamHandler(CommonConsts::STORAGE_DIR_PATH
            ."logs/log_".$date, Logger::DEBUG));
        $this->logger = $logger;
    }

    /**
     * @return TaskDto
     */
    protected function makeExampleTask(): TaskDto
    {
        $taskDto = new \App\Inventory\TaskDto();

        $taskDto->setCrawlerType(ClientConsts::PLAIN_DOWNLOADER);
        $taskDto->setRequestsConcurrencyValue(10);

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

        $taskDto->setUrls($this->makeExampleUrls());

        $taskDto->setResponseHandlerType(ClientConsts::FILES_HANDLER);
        $taskDto->setFileSavingPath(CommonConsts::STORAGE_DIR_PATH."files");

        $taskDto->setTaskUUID(Uuid::uuid4()->toString());
        $taskDto->setStorageDisk(ClientConsts::S3);

        return $taskDto;
    }

    /**
     * @return array
     */
    protected function makeExampleUrls(): array
    {
        $urls = [];
        for ($i = 0; $i < 10; $i++) {
            $urls[] = 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/08/Sphere_wireframe.svg/400px-Sphere_wireframe.svg.png';
        }
        $urls[] = 'https://wikipedia.org';
        return $urls;
    }

    /**
     * @return Crawler
     */
    public function getCrawler(): Crawler
    {
        return $this->crawler;
    }
}
