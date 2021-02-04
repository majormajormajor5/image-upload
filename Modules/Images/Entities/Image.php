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
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }
}
