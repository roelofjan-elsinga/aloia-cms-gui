<?php


namespace AloiaCms\GUI\Controllers;

use AloiaCms\FileManager;
use AloiaCms\GUI\Requests\UploadFileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Contracts\View\View as ViewResponse;

class FileManagerController extends Controller
{

    /**
     * Show the overview page with uploaded files
     *
     * @return ViewResponse
     */
    public function index(): ViewResponse
    {
        $this->setTitle(_translate('MANAGE_UPLOADED_FILES'));

        return View::make('aloiacmsgui::file-manager.index', [
            'files' => FileManager::all()
        ]);
    }

    /**
     * Show the page to upload a new file
     *
     * @return ViewResponse
     */
    public function create(): ViewResponse
    {
        $this->setTitle(_translate('UPLOAD_A_NEW_FILE'));

        return View::make('aloiacmsgui::file-manager.create');
    }

    /**
     * Upload a new file and redirect back to the file overview
     *
     * @param UploadFileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UploadFileRequest $request): RedirectResponse
    {
        $request->save();

        return Redirect::route('files.index')->with('upload_success', true);
    }

    /**
     * Delete a file with the given name and redirect back to the file overview
     *
     * @param string $file_name
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $file_name): RedirectResponse
    {
        FileManager::delete($file_name);

        return Redirect::route('files.index')->with('delete_success', true);
    }
}
