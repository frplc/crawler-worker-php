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
    protected int $requestsConcurrencyValue;

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
     * @var string
     */
    protected string $taskUuid;

    /**
     * @var string
     */
    protected string $storageDisk;

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
     * @param int $requestsConcurrencyValue
     */
    public function setRequestsConcurrencyValue(int $requestsConcurrencyValue): void
    {
        $this->requestsConcurrencyValue = $requestsConcurrencyValue;
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
    public function getRequestsConcurrencyValue(): int
    {
        return $this->requestsConcurrencyValue;
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

    /**
     * @return string
     */
    public function getTaskUuid(): string
    {
        return $this->taskUuid;
    }

    /**
     * @param string $taskUuid
     */
    public function setTaskUuid(string $taskUuid): void
    {
        $this->taskUuid = $taskUuid;
    }

    /**
     * @return string
     */
    public function getStorageDisk(): string
    {
        return $this->storageDisk;
    }

    /**
     * @param string $storageDisk
     */
    public function setStorageDisk(string $storageDisk): void
    {
        $this->storageDisk = $storageDisk;
    }

}
