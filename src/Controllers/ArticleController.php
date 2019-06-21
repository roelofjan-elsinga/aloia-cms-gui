<?php

namespace FlatFileCms\GUI\Controllers;

use FlatFileCms\GUI\Requests\CreateArticleRequest;
use FlatFileCms\GUI\Requests\UpdateArticleRequest;
use FlatFileCms\Article;
use Illuminate\View\View;

class ArticleController
{

    /**
     * Create a new article
     *
     * @return View
     */
    public function create(): View
    {
        return view('flatfilecmsgui::articles.create');
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

        return redirect()->route('dashboard')->with('create_article', true);
    }

    /**
     * Edit the article for the given slug
     *
     * @param string $slug
     * @return View
     */
    public function edit(string $slug): View
    {
        $article = Article::forSlug($slug);

        return view('flatfilecmsgui::articles.edit', [
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

        return redirect()->route('dashboard')->with('updated_article', true);
    }
}
