<?php

namespace FlatFileCms\GUI\Requests;

use FlatFileCms\GUI\Publish\PostPublisher;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;
use FlatFileCms\Article;
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
    public function save(): void
    {
        $folder_path = Config::get('flatfilecms.articles.folder_path');

        if(! file_exists($folder_path)) {
            mkdir($folder_path);
        }

        File::put(
            "{$folder_path}/{$this->get('slug')}.md",
            trim($this->get('content'))
        );

        $this->savePostAttributes([
            'filename' => "{$this->get('slug')}.md",
            'description' => $this->get('description'),
            'postDate' => $this->get('post_date'),
            'isPublished' => $this->get('published') === "1",
            'isScheduled' => $this->get('scheduled') === "1",
        ]);

        if($this->get('published') === "1") {
            PostPublisher::forSlug($this->get('slug'))->publish();
        }
    }

    /**
     * Write the changes to the article to file
     *
     * @param array $new_article_attributes
     */
    private function savePostAttributes(array $new_article_attributes): void
    {
        $articles = Article::raw()
            ->push($new_article_attributes);

        Article::update($articles);
    }
}
