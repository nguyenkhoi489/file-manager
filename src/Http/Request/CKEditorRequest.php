<?php

namespace NguyenKhoi\FileManager\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class CKEditorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'upload' => 'required|mimetypes:' . implode(',', config('file-manager.mime_types')) . '',
        ];
    }

    public function messages(): array
    {
        return [
            'upload.required' => 'The file upload field is required.',
            'upload.mimetypes' => 'The file upload must be type :values.',
        ];
    }
}
