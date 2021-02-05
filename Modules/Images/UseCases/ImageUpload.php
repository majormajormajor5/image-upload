<?php

declare(strict_types=1);

namespace Modules\Images\UseCases;

use Modules\Images\Entities\Image;

/**
 * Interface ImageUpload
 * @package Modules\Images\UseCases
 */
interface ImageUpload
{
    /**
     * @param Image $image
     */
    public function uploadImage(Image $image): void;
}
