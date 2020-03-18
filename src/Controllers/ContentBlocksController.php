<?php

namespace AloiaCms\GUI\Controllers;

use AloiaCms\Models\ContentBlock;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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

        return View::make('aloiacmsgui::content-blocks.index', [
            'blocks' => ContentBlock::all()
                ->map(function (ContentBlock $block) {
                    return [
                        'name' => $block->filename(),
                        'extension' => $block->extension()
                    ];
                })
        ]);
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

        return View::make('aloiacmsgui::content-blocks.create', [
            'file_type' => $request->has('file_type') ? $request->get('file_type') : 'html'
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
        ContentBlock::find($request->get('name'))
            ->setExtension($request->get('file_type'))
            ->setBody($request->get('content'))
            ->save();

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

        $file_path = ContentBlock::find($name);

        if (!$file_path->exists()) {
            App::abort(404);
        }

        return View::make('aloiacmsgui::content-blocks.edit', [
            'name' => $file_path->filename(),
            'extension' => $file_path->extension(),
            'content' => $file_path->rawBody()
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
        ContentBlock::find($name)
            ->setBody($request->get('content'))
            ->save();

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
        ContentBlock::find($name)->delete();

        return Redirect::route('content-blocks.index')->with('success', 'deleted');
    }
}
