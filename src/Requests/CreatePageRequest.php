<?php

namespace FlatFileCms\GUI\Requests;

use FlatFileCms\Page;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Http\FormRequest;

class CreatePageRequest extends FormRequest
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
        $folder_path = Config::get('flatfilecms.pages.folder_path');

        if(! file_exists($folder_path)) {
            mkdir($folder_path);
        }

        File::put(
            "{$folder_path}/{$this->get('slug')}.{$this->get('file_type')}",
            trim($this->get('content'))
        );

        $this->savePostAttributes([
            'title' => $this->get('title'),
            'filename' => "{$this->get('slug')}.{$this->get('file_type')}",
            'description' => $this->get('description'),
            'summary' => $this->get('summary'),
            'author' => $this->get('author'),
            'canonical' => $this->get('canonical'),
            'in_menu' => $this->get('in_menu') === "1",
            'keywords' => $this->get('keywords'),
            'image' => $this->get('image'),
            'postDate' => $this->get('post_date'),
            'isPublished' => $this->get('published') === "1",
            'isScheduled' => $this->get('scheduled') === "1",
            'template_name' => $this->get('template_name'),
        ]);
    }

    /**
     * Write the changes to the article to file
     *
     * @param array $new_article_attributes
     */
    private function savePostAttributes(array $new_article_attributes): void
    {
        $articles = Page::raw()
            ->push(\FlatFileCms\DataSource\Page::create($new_article_attributes)->toArray());

        Page::update($articles);
    }
}