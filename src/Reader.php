<?php

namespace RssTagram;

use DateTime;
use DateTimeInterface;
use DOMDocument;
use DOMNode;

/**
 * Class Reader provides means to read MRSS channel.
 *
 * @package RssTagram
 */
class Reader
{
    /**
     * @var \DOMDocument
     */
    protected $reader;

    public function __construct(DOMDocument $reader)
    {
        $this->reader = $reader;
    }

    /**
     * Loads channel items.
     *
     * @param string $xml
     * @return \DOMElement[]
     */
    public function getItems(string $xml): array
    {
        $items = [];

        $this->reader->loadXML($xml);

        foreach ($this->reader->getElementsByTagName('item') as $item) {
            $pubDate = $this->getPublishedDate($item);

            $timestamp = $this->convertDateToTimestamp($pubDate);

            $items[$timestamp] = $item;
        }

        return $items;
    }

    /**
     * Extracts pubDate from channel item.
     *
     * @param DOMNode $entry
     *
     * @return string
     */
    protected function getPublishedDate(DOMNode $entry): string
    {
        foreach ($entry->childNodes as $childNode) {
            if ($childNode->nodeName === 'pubDate') {
                return $childNode->nodeValue;
            }
        }

        return '';
    }

    /**
     * Converts pubDate to UNIX timestamp.
     *
     * @param string $date
     *
     * @return int
     */
    protected function convertDateToTimestamp(string $date): int
    {
        return DateTime::createFromFormat(DateTimeInterface::RFC1123, $date)->getTimestamp();
    }
}
