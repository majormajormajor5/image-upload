<?php

namespace Modules\Images\UseCases;

use Modules\Images\Entities\Image;

interface ImageUpload
{
    public function uploadImage(Image $image): string;
}
