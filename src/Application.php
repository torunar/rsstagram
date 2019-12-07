<?php

namespace RssTagram;

use DisplayAction;
use DOMElement;
use Exception;

/**
 * Class Application aggregates feeds from multiple Instagram sources.
 *
 * @package RssTagram
 */
class Application
{
    /**
     * @var Config
     */
    protected $config;
    /**
     * @var Reader
     */
    protected $reader;
    /**
     * @var Writer
     */
    protected $writer;
    /**
     * @var DisplayAction
     */
    protected $displayAction;

    public function __construct(Config $config, Reader $reader, Writer $writer, DisplayAction $displayAction)
    {
        $this->config = $config;
        $this->reader = $reader;
        $this->writer = $writer;
        $this->displayAction = $displayAction;
    }

    /**
     * Fetches aggregate RSS channel.
     *
     * @return string
     */
    public function run(): string
    {
        $entries = [];

        // FIXME: Implement parallel execution
        foreach ($this->config->sources as $i => $username) {
            $entries += $this->getUserFeed($username);
        }

        $this->writer
            ->setTitle($this->config->title)
            ->setLink($this->config->link)
            ->setDescription($this->config->description)
            ->setItems($entries);

        return $this->writer->getRss();
    }

    /**
     * Gets single user feed.
     *
     * @param string $username
     *
     * @return DOMElement[]
     */
    protected function getUserFeed(string $username): array
    {
        $this->displayAction->setUserData([
            'bridge' => 'Rsstagram',
            'format' => 'Mrss',
            'u'      => $username,
            'direct_links' => true,
        ]);

        try {
            ob_start();
            $this->displayAction->execute();
            $singleUserFeed = ob_get_clean();
        } catch (Exception $e) {
            // fail silently when unable to fetch feed
            return [];
        }

        return $this->reader->getItems($singleUserFeed);
    }
}
