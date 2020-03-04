<?php

namespace FlatFileCms\GUI\Controllers;

use AloiaCms\Models\Article;
use FlatFileCms\GUI\Requests\CreateArticleRequest;
use FlatFileCms\GUI\Requests\UpdateArticleRequest;
use Illuminate\Http\Request;
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
        $this->setTitle(_translate("MANAGE_ARTICLES"));

        return View::make('flatfilecmsgui::articles.index', [
            'articles' => Article::all()
                ->map(function (Article $article) {
                    return [
                        'title' => $article->title(),
                        'image' => $article->thumbnail(),
                        'slug' => $article->slug(),
                        'isPublished' => $article->isPublished(),
                        'isScheduled' => $article->isScheduled(),
                        'postDate' => $article->getPostDate()
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
        $this->setTitle(_translate("CREATE_ARTICLE"));

        $request = Request::capture();

        return View::make('flatfilecmsgui::articles.create', [
            'file_type' => $request->has('file_type') ? $request->get('file_type') : 'md'
        ]);
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
            ->with('created_article', true);
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
        $article = Article::find($slug);

        $this->setTitle(_translate_dynamic('EDIT_ARTICLE', $article->title()));

        $request = Request::capture();

        return View::make('flatfilecmsgui::articles.edit', [
            'article' => $article,
            'file_type' => $article->extension()
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

    /**
     * Delete an article for the given slug
     *
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $slug)
    {
        Article::find($slug)->delete();

        return Redirect::route('articles.index')
            ->with('deleted_article', true);
    }
}
