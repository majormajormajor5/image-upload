<?php

namespace Modules\Images\Implementations\UseCases;

use Modules\Images\InterfaceAdapters\Gateways\RxflodevGateway;
use Modules\Images\UseCases\ImageUpload as ImageUploadInterface;
use Modules\Images\Entities\Image;

class ImageUpload implements ImageUploadInterface
{
    private $gateway;

    public function __construct(RxflodevGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function uploadImage(Image $image): string
    {
        return $this->gateway->postImage($image->getBase64());
    }
}

