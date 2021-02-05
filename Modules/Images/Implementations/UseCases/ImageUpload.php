<?php

declare(strict_types=1);

namespace Modules\Images\Implementations\UseCases;

use Illuminate\Support\Facades\Session;
use Modules\Images\InterfaceAdapters\Gateways\RxflodevGateway;
use Modules\Images\UseCases\ImageUpload as ImageUploadInterface;
use Modules\Images\Entities\Image;

/**
 * Class ImageUpload
 * @package Modules\Images\Implementations\UseCases
 */
class ImageUpload implements ImageUploadInterface
{
    /**
     * @var RxflodevGateway
     */
    private $gateway;

    /**
     * ImageUpload constructor.
     * @param RxflodevGateway $gateway
     */
    public function __construct(RxflodevGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @param Image $image
     * @throws \GatewayBadResponseException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function uploadImage(Image $image): void
    {
        $imageUrl = $this->gateway->postImage($image->getBase64());
        $image->setUrl($imageUrl);

        //Probably shouldn't be here
        //But I don't want to implement real persistence here anyway hahaha
        if (!Session::exists('uploadedImages')) {
            Session::put('uploadedImages', []);
        }

        Session::push('uploadedImages', $imageUrl);
    }
}

