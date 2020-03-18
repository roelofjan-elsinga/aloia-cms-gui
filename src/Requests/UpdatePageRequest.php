<?php

namespace AloiaCms\GUI\Requests;

use Carbon\Carbon;
use AloiaCms\Models\Page;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class UpdatePageRequest extends FormRequest implements PersistableFormRequest
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
            'original_url' => 'required',
            'title' => 'required',
            'url' => 'required',
            'content' => 'required',
            'description' => 'required',
            'is_published' => 'required|boolean',
            'summary' => 'required',
            'template_name' => 'required',
        ];
    }

    /**
     * Update the article in the config and content files
     */
    public function save(): void
    {
        $meta_data = !is_null($this->get('meta_data')) ? json_decode($this->get('meta_data'), true) : null;

        if ($this->get('sidebar')) {
            $meta_data = [
                'sidebar' => $this->get('sidebar')
            ];
        }

        $old_slug = basename($this->get('original_url'));
        $new_slug = basename($this->get('url'));
        $full_url = $this->get('url');

        $page = Page::find($old_slug);

        if ($old_slug !== $new_slug) {
            $page = $page->rename($new_slug);
        }

        $page
            ->setExtension($this->get('file_type'))
            ->addMatter('title', $this->get('title'))
            ->addMatter('description', $this->get('description'))
            ->addMatter('post_date', $this->get('post_date'))
            ->addMatter('is_published', $this->get('is_published') === "1")
            ->addMatter('summary', $this->get('summary'))
            ->addMatter('template_name', $this->get('template_name'))
            ->addMatter('menu_name', $this->get('menu_name'))
            ->addMatter('meta_data', $meta_data)
            ->addMatter('in_menu', $this->get('in_menu') === "1")
            ->addMatter('author', $this->get('author'))
            ->addMatter('image', $this->get('image'))
            ->addMatter('canonical', $this->get('canonical'))
            ->addMatter('is_homepage', $this->get('is_homepage') === "1")
            ->addMatter('keywords', $this->get('keywords'))
            ->addMatter('url', $full_url)
            ->setUpdateDate(Carbon::now())
            ->setBody($this->get('content'))
            ->save();
    }
}
