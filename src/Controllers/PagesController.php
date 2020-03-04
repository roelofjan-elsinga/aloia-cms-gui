<?php

namespace FlatFileCms\GUI\Controllers;

use FlatFileCms\GUI\Requests\CreatePageRequest;
use FlatFileCms\GUI\Requests\UpdatePageRequest;
use AloiaCms\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Contracts\View\View as ViewResponse;

class PagesController extends Controller
{

    /**
     * Show all pages
     *
     * @return ViewResponse
     */
    public function index(): ViewResponse
    {
        $this->setTitle(_translate("MANAGE_PAGES"));

        return View::make('flatfilecmsgui::pages.index', [
            'pages' => Page::all()
                ->sortByDesc('title')
                ->values()
        ]);
    }

    /**
     * Create a new article
     *
     * @return ViewResponse
     */
    public function create(): ViewResponse
    {
        $this->setTitle(_translate("CREATE_NEW_PAGE"));

        $request = Request::capture();

        return View::make('flatfilecmsgui::pages.create', [
            'template_name' => 'flatfilecmsgui::templates.default',
            'file_type' => $request->has('file_type') ? $request->get('file_type') : 'html'
        ]);
    }

    /**
     * Save the article to file
     *
     * @param CreatePageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreatePageRequest $request)
    {
        $request->save();

        return Redirect::route('pages.index')
            ->with('created_page', true);
    }

    /**
     * Edit the article for the given slug
     *
     * @param string $slug
     * @return ViewResponse
     * @throws \Exception
     */
    public function edit(string $slug): ViewResponse
    {
        $page = Page::find($slug);

        $this->setTitle(_translate_dynamic('EDIT_ARTICLE', $page->title()));

        return View::make('flatfilecmsgui::pages.edit', [
            'page_resource' => $page,
            'file_type' => $page->extension()
        ]);
    }

    /**
     * Save the changes to the article to files
     *
     * @param UpdatePageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePageRequest $request)
    {
        $request->save();

        return Redirect::route('pages.index')
            ->with('updated_page', true);
    }

    /**
     * Delete an article for the given slug
     *
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $slug)
    {
        Page::find($slug)->delete();

        return Redirect::route('pages.index')
            ->with('deleted_page', true);
    }
}
