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
            'upload.required' => trans('file-manager::file-manager.validation.file_required'),
            'upload.mimetypes' => trans('file-manager::file-manager.validation.file_mime_types',
                [
                    'values' => implode(', ', config('file-manager.mime_types'))
                ]
            ),
        ];
    }
}
