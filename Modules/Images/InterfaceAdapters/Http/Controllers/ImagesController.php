<?php

namespace Modules\Images\InterfaceAdapters\Http\Controllers;

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
//        dd(22);
        return view('images::index');
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
        dd($request->file('image')->getContent());

        $image = $factory->createFromContent($image->getContent());

        $imageUpload->uploadImage($image);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('images::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('images::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}