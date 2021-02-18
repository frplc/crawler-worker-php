<?php
/**
 * Date: 12.02.21
 * Time: 23:52
 */
namespace App\Interfaces;

interface TaskDto
{

    public function setCrawlerType(string $type): void;

    public function setUrls(array $urls): void;

    public function setConcurrencyValue(int $value): void;

    public function setOptions(\StdClass $options): void;

    public function setResponseHandlerType(string $handlerType): void;

    public function setFileSavingPath(string $path): void;

    public function getCrawlerType(): string;

    public function getUrls(): array;

    public function getUrlsQuantity(): int;

    public function getConcurrencyValue(): int;

    public function getOptions(): \StdClass;

    public function getResponseHandlerType(): string;

    public function getFileSavingPath(): string;
}
