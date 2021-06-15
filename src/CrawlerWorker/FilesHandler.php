<?php
declare(strict_types=1);
/**
 * Date: 13.02.21
 * Time: 22:56
 */
namespace App\CrawlerWorker;

use App\CrawlerWorker\Abstracts\BaseResponseHandler;
use App\CrawlerWorker\Interfaces\Crawler;

class FilesHandler extends BaseResponseHandler
{
    /**
     * LinksHandler constructor.
     * @param Crawler $crawler
     */
    public function __construct(Crawler $crawler)
    {
        parent::__construct($crawler);
        $this->prepareSaving();
    }

    /**
     * Creates directory if it doesn't exist
     */
    protected function prepareSaving(): void
    {
        //TODO: resolve preparing based on storage disk

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

        $logger->info($this->getRequestInfoAndTaskUUID());

        //TODO: Resolve storage adapter based on storage disk 

        $fileName = pathinfo($dto->getRequestedUrl(), PATHINFO_BASENAME);
        $filePath = $crawler->getTaskDto()->getFileSavingPath()."/".$fileName;
        file_put_contents($filePath, $dto->getResponse()->getBody());
        $logger->info("File ".$filePath." saved".$this->getTaskUUIDMsg());
    }
}
