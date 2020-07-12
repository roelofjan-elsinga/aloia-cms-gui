<?php

namespace AloiaCms\GUI\Requests;

use AloiaCms\GUI\Helpers\FAQ;
use AloiaCms\GUI\Helpers\Json;
use Carbon\Carbon;
use AloiaCms\GUI\Publish\PostPublisher;
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
        $article = Article::find($this->get('slug'));

        $article
            ->setExtension($this->get('file_type'))
            ->setMatter([
                'description' => $this->get('description'),
                'post_date' => $this->get('post_date'),
                'is_published' => $this->get('is_published') === "1",
                'is_scheduled' => $this->get('is_scheduled') === "1"
            ])
            ->setUpdateDate(Carbon::now())
            ->setBody($this->get('content'));

        if (FAQ::isValid($this->get('faq'))) {
            $article->addMatter('faq', FAQ::format($this->get('faq')));
        }

        $this->storeCustomData($article);

        $article->save();

        if ($this->get('is_published') === "1") {
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
