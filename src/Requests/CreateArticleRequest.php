<?php

namespace FlatFileCms\GUI\Requests;

use Carbon\Carbon;
use FlatFileCms\GUI\Publish\PostPublisher;
use AloiaCms\Models\Article;
use Illuminate\Foundation\Http\FormRequest;

class CreateArticleRequest extends FormRequest implements PersistableFormRequest
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
            'slug' => 'required',
            'file_type' => 'required',
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
        Article::find($this->get('slug'))
            ->setExtension($this->get('file_type'))
            ->setMatter([
                'description' => $this->get('description'),
                'post_date' => $this->get('post_date'),
                'is_published' => $this->get('is_published') === "1",
                'is_scheduled' => $this->get('is_scheduled') === "1"
            ])
            ->setUpdateDate(Carbon::now())
            ->setBody($this->get('content'))
            ->save();

        if ($this->get('is_published') === "1") {
            PostPublisher::forSlug($this->get('slug'))->publish();
        }
    }
}
