<?php
declare(strict_types=1);
/**
 * Date: 12.02.21
 * Time: 23:46
 */
namespace App\Inventory;

use App\Interfaces\TaskDto as ITaskDto;

class TaskDto implements ITaskDto
{

    /**
     * @var string
     */
    protected string $crawlerType;

    /**
     * @var array
     */
    protected array $urls;

    /**
     * @var int
     */
    protected int $concurrencyValue;

    /**
     * @var \StdClass
     */
    protected \StdClass $options;

    /**
     * @var string
     */
    protected string $responseHandlerType;

    /**
     * @var string
     */
    protected string $fileSavingPath;

    /**
     * @param string $responseHandlerType
     */
    public function setResponseHandlerType(string $responseHandlerType): void
    {
        $this->responseHandlerType = $responseHandlerType;
    }

    /**
     * @param \StdClass $options
     */
    public function setOptions(\StdClass $options): void
    {
        $this->options = $options;
    }

    /**
     * @param string $crawlerType
     */
    public function setCrawlerType(string $crawlerType): void
    {
        $this->crawlerType = $crawlerType;
    }

    /**
     * @param array $urls
     */
    public function setUrls(array $urls): void
    {
        $this->urls = $urls;
    }

    /**
     * @param int $concurrencyValue
     */
    public function setConcurrencyValue(int $concurrencyValue): void
    {
        $this->concurrencyValue = $concurrencyValue;
    }

    public function getCrawlerType(): string
    {
        return $this->crawlerType;
    }

    public function getUrls(): array
    {
        return $this->urls;
    }

    public function getUrlsQuantity(): int
    {
        return count($this->getUrls());
    }

    /**
     * @return int
     */
    public function getConcurrencyValue(): int
    {
        return $this->concurrencyValue;
    }

    /**
     * @return \StdClass
     */
    public function getOptions(): \StdClass
    {
        return $this->options;
    }

    /**
     * @return string
     */
    public function getResponseHandlerType(): string
    {
        return $this->responseHandlerType;
    }

    /**
     * @return string
     */
    public function getFileSavingPath(): string
    {
        return $this->fileSavingPath;
    }

    /**
     * @param string $fileSavingPath
     */
    public function setFileSavingPath(string $fileSavingPath): void
    {
        $this->fileSavingPath = $fileSavingPath;
    }

}
