<?php

namespace FlatFileCms\GUI\Requests;


use Carbon\Carbon;
use FlatFileCms\Page;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class UpdatePageRequest extends FormRequest
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
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required',
            'description' => 'required',
            'published' => 'required|boolean',
            'summary' => 'required',
            'template_name' => 'required',
        ];
    }

    /**
     * Update the article in the config and content files
     */
    public function save()
    {
        File::put(
            Config::get('flatfilecms.pages.folder_path') . "/{$this->get('original_slug')}.{$this->get('file_type')}",
            $this->get('content')
        );

        if ($this->get('original_slug') !== $this->get('slug')) {
            $this->renameFile(
                "{$this->get('original_slug')}.{$this->get('file_type')}",
                "{$this->get('slug')}.{$this->get('file_type')}"
            );
        }

        $this->updatePostAttributesForSlug($this->get('original_slug'), [
            'title' => $this->get('title'),
            'filename' => "{$this->get('slug')}.{$this->get('file_type')}",
            'description' => $this->get('description'),
            'summary' => $this->get('summary'),
            'author' => $this->get('author'),
            'canonical' => $this->get('canonical'),
            'in_menu' => $this->get('in_menu') === "1",
            'is_homepage' => $this->get('is_homepage') === "1",
            'keywords' => $this->get('keywords'),
            'image' => $this->get('image'),
            'postDate' => $this->get('post_date'),
            'isPublished' => $this->get('published') === "1",
            'isScheduled' => $this->get('scheduled') === "1",
            'template_name' => $this->get('template_name'),
            'updateDate' => Carbon::now()->toDateTimeString(),
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
            Config::get('flatfilecms.pages.folder_path') . "/{$old_filename}",
            Config::get('flatfilecms.pages.folder_path') . "/{$new_filename}"
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
        $articles = Page::raw()
            ->map(function ($article) use ($old_slug, $new_article_attributes) {
                if (strpos($article['filename'], $old_slug) !== false) {

                    return array_merge($article, $new_article_attributes);
                }

                return \FlatFileCms\DataSource\Page::create($article)->toArray();
            });

        if ($new_article_attributes['is_homepage']) {

            $articles = $this->markOtherPagesAsNotHomepage($articles, $new_article_attributes);

        }

        Page::update($articles);
    }

    /**
     * Mark other pages not matching $new_article as not being the homepage
     *
     * @param Collection $articles
     * @param array $new_article
     * @return Collection
     */
    private function markOtherPagesAsNotHomepage(Collection $articles, array $new_article): Collection
    {
        $articles
            ->map(function (array $page) use ($new_article) {

                if ($page['filename'] !== $new_article['filename']) {
                    $page['is_homepage'] = false;
                }

                return $page;
            });

        return $articles;
    }
}