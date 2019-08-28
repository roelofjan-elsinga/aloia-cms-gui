<?php


namespace FlatFileCms\GUI\Requests;

use FlatFileCms\FileManager;
use Illuminate\Foundation\Http\FormRequest;

class UploadFileRequest extends FormRequest implements PersistableFormRequest
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
            'file' => 'required|file|max:4096'
        ];
    }

    /**
     * Save this request to the filesystem
     */
    public function save(): void
    {
        FileManager::open()->upload($this->file('file'));
    }
}
