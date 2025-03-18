<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileUploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'             => ['required', 'string', 'unique:archives,name'],
            'folder'            => ['required', 'exists:folders,id', 'string'],
            'content'           => ['required', 'string'],
            'encryption_key'    => ['required'],
            'file'              => ['required',  'file']

        ];
    }

    public function attributes()
    {
        return [
            'encryption_key' => 'clé de cryptage'
        ];
    }
}
