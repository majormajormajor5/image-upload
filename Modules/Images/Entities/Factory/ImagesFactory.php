<?php

namespace Modules\Images\Entities\Factory;

use Modules\Images\Entities\Image;

class ImagesFactory
{
    public function createFromContent(string $content): Image
    {
        return new Image($content);
    }
}
