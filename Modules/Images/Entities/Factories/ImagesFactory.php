<?php

declare(strict_types=1);

namespace Modules\Images\Entities\Factories;

use Modules\Images\Entities\Image;

class ImagesFactory
{
    public function createFromContent(string $content): Image
    {
        return new Image($content);
    }
}
