<?php

namespace AloiaCms\GUI\Controllers;

use Gumlet\ImageResize;
use AloiaCms\Media;
use AloiaCms\GUI\Requests\UploadImageRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Contracts\View\View as ViewResponse;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Media $media
     * @return ViewResponse
     */
    public function index(Media $media): ViewResponse
    {
        $this->setTitle(_translate("MANAGE_IMAGES"));

        return View::make('aloiacmsgui::media.index', [
            'images' => $media->allFiles()->onlyFullSize()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return ViewResponse
     */
    public function create(): ViewResponse
    {
        $this->setTitle(_translate("UPLOAD_IMAGE"));

        return View::make('aloiacmsgui::media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UploadImageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Gumlet\ImageResizeException
     */
    public function store(UploadImageRequest $request)
    {
        $file = $request->file('image');

        $extension = $file->getClientOriginalExtension();

        $filename = Media::getImagesPath() . '/' . Media::titleToFilename($request->get('name')) . '.' . $extension;

        $this->saveImageForDimensions(new ImageResize($file), 1200, 800, $filename);

        if ($this->shouldCreateThumbnail($request)) {
            $filename = Media::getImagesPath() . '/' . Media::titleToFilename($request->get('name')) . '_w300.' . $extension;

            $this->saveImageForDimensions(new ImageResize($file), 300, 200, $filename);
        }

        return Redirect::route('media.index')
            ->with('upload_success', true);
    }

    /**
     * Determine whether a thumbnail needs to be created
     *
     * @param UploadImageRequest $request
     * @return bool
     */
    private function shouldCreateThumbnail(UploadImageRequest $request): bool
    {
        return $request->get('including_thumbnail') === "1";
    }

    /**
     * Save the image for the given dimensions with the given filename
     *
     * @param ImageResize $image
     * @param int $width
     * @param int $height
     * @param string $filename
     * @throws \Gumlet\ImageResizeException
     */
    private function saveImageForDimensions(ImageResize $image, int $width, int $height, string $filename)
    {
        $image->crop($width, $height);

        $image->save($filename);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return Response
     */
    public function destroy($id)
    {
        // Implement later
    }
}
