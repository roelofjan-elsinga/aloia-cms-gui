<?php

namespace AloiaCms\GUI\Requests;

use AloiaCms\GUI\Helpers\Json;
use Carbon\Carbon;
use AloiaCms\GUI\Publish\PostPublisher;
use AloiaCms\GUI\Helpers\FAQ;
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
            ->setBody($this->get('content'));

        if (FAQ::isValid($this->get('faq'))) {
            $article->addMatter('faq', FAQ::format($this->get('faq')));
        }

        $this->storeCustomData($article);

        $article->save();

        if (! $isPublished && $this->get('is_published') === "1") {
            PostPublisher::forSlug($this->get('slug'))->publish();
        }
    }

    private function storeCustomData(&$article): void
    {
        $storable_data = $this->except([
            '_method',
            '_token',
            'description',
            'post_date',
            'is_published',
            'is_scheduled',
            'content',
            'faq',
            'file_type',
            'original_slug',
            'slug'
        ]);

        foreach ($storable_data as $key => $value) {
            if (Json::isValid($value)) {
                $value = json_decode($value, true);
            }

            $article->addMatter($key, $value);
        }
    }
}
