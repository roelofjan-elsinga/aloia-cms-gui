<?php

namespace AloiaCms\GUI\Requests;

use AloiaCms\Models\Page;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CreatePageRequest extends FormRequest implements PersistableFormRequest
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
            'url' => 'required',
            'content' => 'required',
            'description' => 'required',
            'is_published' => 'required|boolean',
            'summary' => 'required',
            'template_name' => 'required',
            'file_type' => 'required',
            'post_date' => 'date',
        ];
    }

    /**
     * Update the article in the config and content files
     */
    public function save(): void
    {
        $meta_data = null;

        if ($this->get('sidebar')) {
            $meta_data = [
                'sidebar' => $this->get('sidebar')
            ];
        }

        Page::find($this->get('url'))
            ->setExtension($this->get('file_type'))
            ->setMatter([
                'title' => $this->get('title'),
                'description' => $this->get('description'),
                'is_published' => $this->get('is_published') === "1",
                'is_scheduled' => false,
                'summary' => $this->get('summary'),
                'template_name' => $this->get('template_name') ?? 'default',
                'menu_name' => $this->get('menu_name'),
                'meta_data' => $meta_data,
                'in_menu' => $this->get('in_menu') === "1",
                'author' => $this->get('author'),
                'image' => $this->get('image'),
                'url' => $this->get('url'),
            ])
            ->setPostDate(Carbon::parse($this->get('post_date')))
            ->setBody($this->get('content'))
            ->save();
    }
}
