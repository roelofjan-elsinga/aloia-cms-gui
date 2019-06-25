<?php

namespace FlatFileCms\GUI\Requests;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use FlatFileCms\Article;
use Symfony\Component\HttpFoundation\Request;

class UpdateArticleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'original_slug' => 'required',
            'slug' => 'required',
            'content' => 'required',
            'description' => 'required',
            'post_date' => 'required',
            'published' => 'required|boolean',
            'scheduled' => 'required|boolean',
        ];
    }

    /**
     * Update the article in the config and content files
     */
    public function save()
    {
        File::put(
            resource_path("content/articles/{$this->get('original_slug')}.md"),
            $this->get('content')
        );

        if ($this->get('original_slug') !== $this->get('slug')) {
            $this->renameFile("{$this->get('original_slug')}.md", "{$this->get('slug')}.md");
        }

        $this->updatePostAttributesForSlug($this->get('original_slug'), [
            'filename' => "{$this->get('slug')}.md",
            'description' => $this->get('description'),
            'postDate' => $this->get('post_date'),
            'updateDate' => Carbon::now()->toDateTimeString(),
            'isPublished' => $this->get('published') === "1",
            'isScheduled' => $this->get('scheduled') === "1",
        ]);
    }

    /**
     * Rename the file from the given old filename to the new filename
     *
     * @param string $old_filename
     * @param string $new_filename
     */
    private function renameFile(string $old_filename, string $new_filename): void
    {
        File::move(
            resource_path("content/articles/{$old_filename}"),
            resource_path("content/articles/{$new_filename}")
        );
    }

    /**
     * Write the changes to the article to file
     *
     * @param string $old_slug
     * @param array $new_article_attributes
     */
    private function updatePostAttributesForSlug(string $old_slug, array $new_article_attributes): void
    {
        $articles = Article::raw()
            ->map(function ($article) use ($old_slug, $new_article_attributes) {
                if (strpos($article['filename'], $old_slug) !== false) {
                    return $new_article_attributes;
                }

                return $article;
            });


        Article::update($articles);
    }
}
