<?php


namespace AloiaCms\GUI\Publish;

use AloiaCms\Models\Article;
use Illuminate\Support\Carbon;
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
        Article::find($this->article_slug)
            ->addMatter('is_published', false)
            ->addMatter('is_scheduled', true)
            ->setPostDate(Carbon::now())
            ->save();

        Artisan::call('aloiacms:publish:posts');
    }
}
