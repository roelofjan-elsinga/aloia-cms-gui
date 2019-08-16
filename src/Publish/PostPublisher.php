<?php


namespace FlatFileCms\GUI\Publish;


use FlatFileCms\Article;
use Illuminate\Support\Facades\Artisan;

class PostPublisher
{

    /**
     * @var string
     */
    private $article_slug;

    private function __construct(string $article_slug)
    {
        $this->article_slug = $article_slug;
    }

    /**
     * Named constructor
     *
     * @param string $article_slug
     * @return PostPublisher
     */
    public static function forSlug(string $article_slug): PostPublisher
    {
        return new static($article_slug);
    }

    /**
     * Publish the post
     */
    public function publish(): void
    {
        Article::update(
            Article::raw()
                ->map(function (array $article) {
                    if (strpos($article['filename'], $this->article_slug) !== false) {
                        $article['isPublished'] = false;
                        $article['isScheduled'] = true;
                        $article['postDate'] = date('Y-m-d');
                    }

                    return $article;
                })
        );

        Artisan::call('flatfilecms:publish:posts');
    }

}