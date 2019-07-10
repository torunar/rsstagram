<?php

namespace RssTagram;

use Exception;

/**
 * Class Config contains channel configuration.
 *
 * @package RssTagram
 */
class Config
{
    /**
     * @var string
     */
    public $title;
    /**
     * @var string
     */
    public $link;
    /**
     * @var string[]
     */
    public $sources;
    /**
     * @var string
     */
    public $description;

    public function __construct(string $title, string $link, string $description, array $sources)
    {
        $this->title = $title;
        $this->link = $link;
        $this->description = $description;
        $this->sources = $sources;
    }

    /**
     * Loads configuration from JSON string.
     *
     * @param string $config
     * @return Config
     * @throws Exception
     */
    public static function fromJson(string $config): Config
    {
        $config = json_decode($config);

        $title = $config->title ?? null;
        if ($title === null) {
            throw new Exception('Channel title not specified');
        }

        $link = $config->link ?? null;
        if ($link === null) {
            throw new Exception('Channel link not specified');
        }

        $description = $config->description ?? null;
        if ($description === null) {
            throw new Exception('Channel description not specified');
        }

        $sources = $config->sources ?? null;
        if ($sources === null) {
            throw new Exception('Sources not specified');
        }

        return new static($title, $link, $description, (array) $sources);
    }
}
