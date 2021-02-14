<?php
declare(strict_types=1);
/**
 * Date: 13.02.21
 * Time: 22:56
 */
namespace App\CrawlerWorker;

use App\CrawlerWorker\Abstracts\BaseResponseHandler;
use App\CrawlerWorker\Interfaces\CrawlerWorker;
use App\CrawlerWorker\Interfaces\ResponseHandler;

class FilesHandler extends BaseResponseHandler implements ResponseHandler
{
    /**
     * LinksDigger constructor.
     * @param CrawlerWorker $crawler
     */
    public function __construct(CrawlerWorker $crawler)
    {
        parent::__construct($crawler);
        $this->prepareSaving();
    }

    /**
     * Creates directory if it doesn't exist
     */
    protected function prepareSaving(): void
    {
        $saveDirectory = $this->crawler->getTaskDto()->getFileSavingPath();
        if (!is_dir($saveDirectory)) {
            mkdir($saveDirectory);
        }
    }

    /**
     * @inheritdoc
     */
    public function handleSuccessfulResponse(): void
    {
        $this->saveFile();
    }

    /**
     * Save files depends on CrawlerDto properties
     */
    protected function saveFile(): void
    {
        $crawler = $this->crawler;
        $dto = $this->getCrawlerDto();
        $logger = $crawler->getLogger();

        $logger->info("Request index: ".$dto->getRequestIndex());
        $logger->info("Request url: " .$dto->getRequestedUrl());

        $fileName = pathinfo($dto->getRequestedUrl(), PATHINFO_BASENAME);
        $filePath = $crawler->getTaskDto()->getFileSavingPath()."/".$fileName;
        file_put_contents($filePath, $dto->getResponse()->getBody());
        $logger->info("File ".$filePath." saved");
    }
}
