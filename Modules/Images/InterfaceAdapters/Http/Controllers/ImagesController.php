<?php

namespace Modules\Images\InterfaceAdapters\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Images\Entities\Factory\ImagesFactory;
use Modules\Images\UseCases\ImageUpload;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('images::index');
    }

    public function getAllUploadedImages()
    {
        return json_encode([
            'storedUrls'=> Session::get('uploadedImages') ?? []
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('images::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param ImageUpload $imageUpload
     * @return Renderable
     */
    public function store(Request $request, ImageUpload $imageUpload, ImagesFactory $factory)
    {
        $image = $request->file('image');
        //validation goes here
//        dd($request->file('image')->getContent());
        $image = $factory->createFromContent($image->getContent());

        return json_encode([
            'returnedUrl' => $imageUpload->uploadImage($image)
        ]);
    }
}
