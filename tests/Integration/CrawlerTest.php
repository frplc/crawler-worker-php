<?php
declare(strict_types=1);
/**
 * Date: 18.03.21
 * Time: 11:23
 */
namespace Tests\Integration;

use App\Commands\ClientCommand;
use App\CrawlerWorker\Interfaces\Crawler;
use PHPUnit\Framework\TestCase;

final class CrawlerTest extends TestCase
{
    protected Crawler $crawler;

    public function setUp(): void
    {
        parent::setUp();
        $this->command = new ClientCommand();
        $this->command->handle();
        $this->crawler = $this->command->getCrawler();
    }

    public function testExecuteCrawlingCorrectly()
    {
        $madeRequestsQuantity = $this->crawler->getSuccessfulRequestsQuantity()
            + $this->crawler->getRejectedRequestsQuantity();
        $this->assertEquals($this->getPlannedRequestsQuantity(), $madeRequestsQuantity);
    }

    public function testExecuteCrawlingSuccessfully()
    {
        $this->assertEquals($this->getPlannedRequestsQuantity(), $this->crawler->getSuccessfulRequestsQuantity());
    }

    protected function getPlannedRequestsQuantity(): int
    {
        return $plannedRequestsQuantity = count($this->crawler->getTaskDto()->getUrls());
    }
}
