<?php
/**
 * Date: 13.02.21
 * Time: 23:33
 */
namespace App\Services\Interfaces;

interface CrawlerDto
{

    public function getResponse();

    public function getRequestedUrl(): string;

    public function getRequestIndex(): int;

}
