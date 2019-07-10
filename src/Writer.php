<?php

namespace RssTagram;

use DOMDocument;
use DOMNode;

/**
 * Class Writer provides means to write MRSS channel.
 *
 * @package RssTagram
 */
class Writer
{
    /**
     * @var DOMDocument
     */
    protected $writer;
    /**
     * @var \DOMElement
     */
    protected $rss;
    /**
     * @var \DOMElement
     */
    protected $channel;

    public function __construct(DOMDocument $writer)
    {
        $this->writer = $writer;

        $this->rss = $this->writer->createElement('rss');
        $this->writer->appendChild($this->rss);

        $this->rss->setAttribute('version', '2.0');
        $this->rss->setAttribute('xmlns:media', 'http://search.yahoo.com/mrss/');
        $this->rss->setAttribute('xmlns:atom', 'http://www.w3.org/2005/Atom');

        $this->channel = $this->writer->createElement('channel');
        $this->rss->appendChild($this->channel);
    }

    /**
     * Sets channel title.
     *
     * @param string $title
     *
     * @return Writer
     */
    public function setTitle(string $title): Writer
    {
        $this->channel->appendChild(
            $this->writer->createElement('title', $title)
        );

        return $this;
    }

    /**
     * Sets channel link.
     *
     * @param string $link
     *
     * @return Writer
     */
    public function setLink(string $link): Writer
    {
        $this->channel->appendChild(
            $this->writer->createElement('link', $link)
        );

        return $this;
    }

    /**
     * Sets channel description.
     *
     * @param string $description
     *
     * @return Writer
     */
    public function setDescription(string $description): Writer
    {
        $this->channel->appendChild(
            $this->writer->createElement('description', $description)
        );

        return $this;
    }

    /**
     * Sets channel items.
     *
     * @param DOMNode[] $items
     *
     * @return Writer
     */
    public function setItems(array $items): Writer
    {
        // sort items by timestamp
        krsort($items);

        foreach ($items as $item) {
            $item = $this->writer->importNode($item, true);
            $this->channel->appendChild($item);
        }

        return $this;
    }

    /**
     * Returns RSS feed contents.
     *
     * @return string
     */
    public function getRss(): string
    {
        return $this->writer->saveXML();
    }
}
