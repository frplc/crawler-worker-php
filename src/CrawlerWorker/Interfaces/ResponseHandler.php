<?php
/**
 * Date: 13.02.21
 * Time: 23:06
 */
namespace App\CrawlerWorker\Interfaces;

interface ResponseHandler
{
    /**
     * Handle response with 2** status code
     */
    public function handleSuccessfulResponse(): void;

    /**
     * Handle rejected response
     */
    public function handleRejectedResponse(): void;

    /**
     * @param CrawlerDto $dto
     */
    public function setCrawlerDto(CrawlerDto $dto): void;

}
