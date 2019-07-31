<?php

namespace FlatFileCms\GUI\Controllers;

use FlatFileCms\TagsParser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Contracts\View\View as ViewResponse;

class ContentBlocksController extends Controller
{

    /**
     * Return a page to show all content blocks
     *
     * @return ViewResponse
     */
    public function index(): ViewResponse
    {
        $this->setTitle(_translate("MANAGE_CONTENT_BLOCKS"));

        return View::make('flatfilecmsgui::content-blocks.index', [
            'blocks' => $this->getContentFiles()
        ]);
    }

    /**
     * Get the content files from the blocks folder
     *
     * @return Collection
     */
    private function getContentFiles(): Collection
    {
        return Collection::make(
            File::allFiles(
                Config::get('flatfilecms.content_blocks.folder_path')
            )
        )
            ->map(function(string $file_path) {

                return [
                    'name' => pathinfo($file_path, PATHINFO_FILENAME),
                    'extension' => pathinfo($file_path, PATHINFO_EXTENSION),
                    'path' => $file_path
                ];

            });
    }

    /**
     * Show the page to create a new content block
     *
     * @return ViewResponse
     */
    public function create(): ViewResponse
    {
        $this->setTitle(_translate("CREATE_CONTENT_BLOCK"));

        $request = Request::capture();

        return View::make('flatfilecmsgui::content-blocks.create', [
            'file_type' => $request->has('file_type') ? $request->get('file_type') : 'html',
            'page' => TagsParser::instance()->getTagsForPageName('create_content_blocks')
        ]);
    }

    /**
     * Save the newly created content block
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $file_name = "{$request->get('name')}.{$request->get('file_type')}";

        $file_path = Config::get('flatfilecms.content_blocks.folder_path') . "/{$file_name}";

        file_put_contents($file_path, $request->get('content'));

        return Redirect::route('content-blocks.index')->with('success', 'created');
    }

    /**
     * Edit the content block for the given name
     *
     * @param string $name
     * @return ViewResponse
     */
    public function edit(string $name): ViewResponse
    {
        $this->setTitle(_translate_dynamic('EDIT_CONTENT_BLOCK', $name));

        $file_path = $this->getContentFiles()
            ->filter(function(array $file) use ($name) {
                return $file['name'] === $name;
            })
            ->first();

        if(is_null($file_path)) {
            App::abort(404);
        }

        return View::make('flatfilecmsgui::content-blocks.edit', [
            'name' => $file_path['name'],
            'extension' => $file_path['extension'],
            'file_path' => $file_path['path'],
            'content' => file_get_contents($file_path['path']),
            'page' => TagsParser::instance()->getTagsForPageName('edit_content_blocks')
        ]);
    }

    /**
     * Update the content block
     *
     * @param Request $request
     * @param string $name
     * @return RedirectResponse
     */
    public function update(Request $request, string $name): RedirectResponse
    {
        file_put_contents($request->get('file_path'), $request->get('content'));

        return Redirect::route('content-blocks.index');
    }

    /**
     * Delete the block for the given name
     *
     * @param string $name
     * @return RedirectResponse
     */
    public function destroy(string $name): RedirectResponse
    {
        $file_path = $this->getContentFiles()
            ->filter(function(array $file) use ($name) {
                return $file['name'] === $name;
            })
            ->first();

        if(is_null($file_path)) {
            return Redirect::back()->with('error', 'not_found');
        }

        File::delete($file_path['path']);

        return Redirect::route('content-blocks.index')->with('success', 'deleted');
    }

}
