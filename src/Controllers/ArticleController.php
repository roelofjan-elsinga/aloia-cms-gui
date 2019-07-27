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
     * Show all articles
     *
     * @return ViewResponse
     */
    public function index(): ViewResponse
    {
        $this->setTitle("Manage articles");

        return View::make('flatfilecmsgui::articles.index', [
            'articles' => Article::all()
                ->map(function (Article $article) {
                    return [
                        'title' => $article->title(),
                        'image' => $article->thumbnail(),
                        'slug' => $article->slug(),
                        'isPublished' => $article->isPublished(),
                        'isScheduled' => $article->isScheduled(),
                        'postDate' => $article->rawPostDate()
                    ];
                })
                ->sortByDesc('postDate')
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
        $this->setTitle("Create an article");

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

        return Redirect::route('articles.index')
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
        $this->setTitle("Edit an article");

        $article = Article::forSlug($slug);

        return View::make('flatfilecmsgui::articles.edit', [
            'article' => $article
        ]);
    }

    /**
     * Save the changes to the article to files
     *
     * @param UpdateArticleRequest $request
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateArticleRequest $request, string $slug)
    {
        $request->save();

        return Redirect::route('articles.index')
            ->with('updated_article', true);
    }
}
