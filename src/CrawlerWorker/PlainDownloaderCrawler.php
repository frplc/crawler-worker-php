<?php
declare(strict_types=1);
/**
 * Date: 12.02.21
 * Time: 22:26
 */
namespace App\CrawlerWorker;

use App\CrawlerWorker\Abstracts\BaseCrawlerWorker;

use App\CrawlerWorker\Inventory\PlainDownloaderDto;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

/**
 * Crawler based on Guzzle, aimed to make concurrent plain downloads of URLs (pages, images, etc.)
 *
 * Class PlainDownloaderCrawler
 * @package App\CrawlerWorker
 */
class PlainDownloaderCrawler extends BaseCrawlerWorker
{

    /**
     * {@var ClientAdapter}
     */
    protected $client;

    /**
     * Initialize specific crawler params and settings based on TaskDto data
     */
    public function configure(): void
    {
        parent::configure();

        $this->client = $this->prepareClient();
    }

    /**
     * Set any needed Client's options
     *
     * @return Client
     */
    protected function prepareClient(): Client
    {
        return new Client([
            'timeout' => 10
        ]);
    }

    /**
     * @inheritdoc
     */
    public function crawl(): void
    {
        $pool = $this->makeRequestsPool($this->client, $this->prepareRequests());
        $promise = $pool->promise();
        $promise->wait();
    }

    /**
     * @return callable
     */
    protected function prepareRequests(): callable
    {
        $requests = function () {
            foreach ($this->taskDto->getUrls() as $url) {
                yield new Request('GET', $url);
            }
        };
        return $requests;
    }

    /**
     * @param $client
     * @param callable $requests
     * @return Pool
     */
    protected function makeRequestsPool($client, callable $requests): Pool
    {
        return new Pool($client, $requests(), [
            'concurrency' => $this->taskDto->getConcurrencyValue(),
            'options' => $this->prepareRequestsOptions(),
            'fulfilled' => function (Response $response, $index) {
                $this->successfulRequestsQuantity++;
                $this->crawlSuccessfully($response, $index);
            },
            'rejected' => function (RequestException $reason, $index) {
                $this->rejectedRequestsQuantity++;
                $this->crawlRejected($reason, $index);
            },
        ]);
    }

    /**
     * Set any needed options for requests in the request's pool
     *
     * @return array
     */
    protected function prepareRequestsOptions(): array
    {
        return [
            'debug' => $this->taskDto->getOptions()->debug,
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36',
                "Accept" => "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8",
                "Accept-encoding" => "gzip, deflate, br",
                "Accept-language" => "en,ru;q=0.9,it;q=0.8,en-US;q=0.7",
                "Cache-control" => "no-cache",
            ]
        ];
    }

    /**
     * @param Response $response
     * @param $requestIndex
     */
    protected function crawlSuccessfully(Response $response, $requestIndex): void
    {
        $crawlerDto = new PlainDownloaderDto();
        $crawlerDto->setResponse($response);
        $crawlerDto->setRequestIndex($requestIndex);
        $crawlerDto->setRequestedUrl($this->getRequestedUrl($requestIndex));

        $responseHandler = ResponseHandlerFactory::makeResponseHandler($this);
        $responseHandler->setCrawlerDto($crawlerDto);
        $responseHandler->handleSuccessfulResponse();
    }

    /**
     * @param int $requestIndex
     * @return string
     */
    protected function getRequestedUrl(int $requestIndex): string
    {
        return $this->taskDto->getUrls()[$requestIndex];
    }

    /**
     * @param RequestException $reason
     * @param $requestIndex
     */
    protected function crawlRejected(RequestException $reason, $requestIndex): void
    {
        $crawlerDto = new PlainDownloaderDto();
        $crawlerDto->setRequestException($reason);
        $crawlerDto->setRequestIndex($requestIndex);
        $crawlerDto->setRequestedUrl($this->getRequestedUrl($requestIndex));

        $responseHandler = ResponseHandlerFactory::makeResponseHandler($this);
        $responseHandler->setCrawlerDto($crawlerDto);
        $responseHandler->handleRejectedResponse();
    }
}
