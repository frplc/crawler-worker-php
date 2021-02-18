<?php
declare(strict_types=1);
/**
 * Date: 13.02.21
 * Time: 23:23
 */
namespace App\CrawlerWorker\Inventory;

use App\CrawlerWorker\Abstracts\BaseCrawlerDto;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;

class PlainDownloaderDto extends BaseCrawlerDto
{

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var RequestException
     */
    protected $requestException;

    /**
     * @param Response $response
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
    }

    /**
     * @param RequestException $requestException
     */
    public function setRequestException(RequestException $requestException)
    {
        $this->requestException = $requestException;
    }

    /**
     * @return RequestException
     */
    public function getRequestException(): RequestException
    {
        return $this->requestException;
    }

    /**
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }

}
