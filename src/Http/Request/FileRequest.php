<?php

namespace NguyenKhoi\FileManager\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'files' => 'required',
            'folderId' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'files.required' => trans('file-manager::file-manager.validation.file_required'),
            'folderId.required' => trans('file-manager::file-manager.validation.folder_id_required'),
            'folderId.integer' => trans('file-manager::file-manager.validation.folder_id_integer')
        ];
    }
}
