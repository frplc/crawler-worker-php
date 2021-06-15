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

    public function setUp(): void
    {
        parent::setUp();
        $this->command = new ClientCommand();
    }

    public function testExecuteCrawlingCorrectly()
    {
        $this->command->handle();

        /**
         * @var Crawler $crawler
         */
        $crawler = $this->command->getCrawler();

        $plannedRequestsQuantity = count($crawler->getTaskDto()->getUrls());
        $madeRequestsQuantity = $crawler->getSuccessfulRequestsQuantity()
            + $crawler->getRejectedRequestsQuantity();
        $this->assertEquals($plannedRequestsQuantity, $madeRequestsQuantity);
    }

}
