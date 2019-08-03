<?php

namespace FlatFileCms\GUI\Controllers;

use FlatFileCms\GUI\Requests\CreatePageRequest;
use FlatFileCms\GUI\Requests\UpdatePageRequest;
use FlatFileCms\Page;
use FlatFileCms\Taxonomy\Taxonomy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
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
        $this->setTitle(_translate("EDIT_YOUR_PAGES"));

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
            'file_type' => $request->has('file_type') ? $request->get('file_type') : 'html',
            'categories' => Taxonomy::get()
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
            ->with('create_article', true);
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
        $page = Page::forSlug($slug);

        $this->setTitle(_translate_dynamic('EDIT_ARTICLE', $page->title()));

        return View::make('flatfilecmsgui::pages.edit', [
            'page_resource' => $page,
            'file_type' => pathinfo($page->filename(), PATHINFO_EXTENSION),
            'categories' => Taxonomy::get()
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
            ->with('updated_article', true);
    }

}