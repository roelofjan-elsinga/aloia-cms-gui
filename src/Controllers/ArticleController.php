<?php

namespace FlatFileCms\GUI\Controllers;

use FlatFileCms\GUI\Requests\CreateArticleRequest;
use FlatFileCms\GUI\Requests\UpdateArticleRequest;
use FlatFileCms\Article;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Contracts\View\View as ViewResponse;

class ArticleController extends Controller
{

    /**
     * Create a new article
     *
     * @return ViewResponse
     */
    public function create(): ViewResponse
    {
        return View::make('flatfilecmsgui::articles.create');
    }

    /**
     * Save the article to file
     *
     * @param UpdateArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateArticleRequest $request)
    {
        $request->save();

        return Redirect::to( Config::get('flatfilecmsgui.dashboard_url') )
            ->with('create_article', true);
    }

    /**
     * Edit the article for the given slug
     *
     * @param string $slug
     * @return ViewResponse
     */
    public function edit(string $slug): ViewResponse
    {
        $article = Article::forSlug($slug);

        return View::make('flatfilecmsgui::articles.edit', [
            'article' => $article
        ]);
    }

    /**
     * Save the changes to the article to files
     *
     * @param UpdateArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateArticleRequest $request)
    {
        $request->save();

        return Redirect::to( Config::get('flatfilecmsgui.dashboard_url') )
            ->with('updated_article', true);
    }
}
