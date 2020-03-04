<?php

namespace FlatFileCms\GUI\Requests;

use Carbon\Carbon;
use FlatFileCms\GUI\Publish\PostPublisher;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use AloiaCms\Models\Article;
use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest implements PersistableFormRequest
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
            'file_type' => 'required',
            'original_slug' => 'required',
            'slug' => 'required',
            'content' => 'required',
            'description' => 'required',
            'post_date' => 'required',
            'is_published' => 'required|boolean',
            'is_scheduled' => 'required|boolean',
        ];
    }

    /**
     * Update the article in the config and content files
     */
    public function save(): void
    {
        $article = Article::find($this->get('original_slug'));

        if ($this->get('original_slug') !== $this->get('slug')) {
            $article = $article->rename($this->get('slug'));
        }

        $isPublished = $article->isPublished();

        $article
            ->setExtension($this->get('file_type'))
            ->addMatter('description', $this->get('description'))
            ->addMatter('post_date', $this->get('post_date'))
            ->addMatter('is_published', $this->get('is_published') === "1")
            ->addMatter('is_scheduled', $this->get('is_scheduled') === "1")
            ->setUpdateDate(Carbon::now())
            ->setBody($this->get('content'))
            ->save();

        if (! $isPublished && $this->get('is_published') === "1") {
            PostPublisher::forSlug($this->get('slug'))->publish();
        }
    }
}
