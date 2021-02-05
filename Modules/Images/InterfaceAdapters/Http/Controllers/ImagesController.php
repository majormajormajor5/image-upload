<?php

namespace Modules\Images\InterfaceAdapters\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Images\Entities\Factory\ImagesFactory;
use Modules\Images\UseCases\ImageUpload;

class ImagesController extends Controller
{
    /**
     * @return Renderable
     */
    public function index()
    {
        return view('images::index');
    }

    /**
     * @return string
     */
    public function getAllUploadedImages(): string
    {
        return json_encode([
            'storedUrls'=> Session::get('uploadedImages') ? array_reverse(Session::get('uploadedImages')) : []
        ]);
    }

    /**
     * @param Request $request
     * @param ImageUpload $imageUpload
     * @param ImagesFactory $factory
     * @return string
     */
    public function store(Request $request, ImageUpload $imageUpload, ImagesFactory $factory): string
    {
        $request->validate([
            'image' => 'required|mimes:png'
        ]);

        $image = $request->file('image');

        $image = $factory->createFromContent($image->getContent());

        return json_encode([
            'returnedUrl' => $imageUpload->uploadImage($image)
        ]);
    }
}
