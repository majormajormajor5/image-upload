<?php

namespace Modules\Images\Entities;

/**
 * Class Image
 * @package Modules\Images\Entities
 */
class Image
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string|null
     */
    private $content;

    /**
     * @var
     */
    private $url;

    /**
     * Image constructor.
     * @param string|null $content
     */
    public function __construct(
        ?string $content
    ) {
        $this->id = uniqid("", true);
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @return string|null
     */
    public function getBase64(): ?string
    {
        return base64_encode($this->content);
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }
}
