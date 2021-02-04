<?php

namespace Modules\Images\Entities;

class Image
{
    private $id;

    private $content;

    public function __construct(
        ?string $content
    ) {
        $this->id = uniqid("", true);
        $this->content = $content;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getBase64(): ?string
    {
        return base64_encode($this->content);
    }
}
