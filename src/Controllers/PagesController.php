<?php

namespace AloiaCms\GUI\Controllers;

use AloiaCms\GUI\Requests\CreatePageRequest;
use AloiaCms\GUI\Requests\UpdatePageRequest;
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
        $this->setTitle(trans("aloiacmsgui::pages.manage"));

        $page = request()->get('page') ?? 1;

        $pages = Page::all()
            ->sortByDesc('title');

        if (request()->get('q')) {
            $pages = $pages
                ->filter(function (Page $pages) {
                    return strpos(strtolower($pages->title()), strtolower(request()->get('q'))) !== false
                        || strpos(strtolower($pages->description()), strtolower(request()->get('q'))) !== false
                        || strpos(strtolower($pages->body()), strtolower(request()->get('q'))) !== false;
                });
        }

        return View::make('aloiacmsgui::pages.index', [
            'pages' => $this->getPaginator($pages->values(), route('pages.index'), $page, 10)
        ]);
    }

    /**
     * Create a new article
     *
     * @return ViewResponse
     */
    public function create(): ViewResponse
    {
        $this->setTitle(trans("aloiacmsgui::pages.create_new"));

        $request = Request::capture();

        return View::make('aloiacmsgui::pages.create', [
            'template_name' => 'aloiacmsgui::templates.default',
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

        $this->setTitle(trans('aloiacmsgui::articles.edit', ['title' => $page->title()]));

        return View::make('aloiacmsgui::pages.edit', [
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
