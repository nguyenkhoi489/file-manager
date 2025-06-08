<?php

namespace NguyenKhoi\FileManager\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class FolderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'nullable',
            'name' => 'required|string',
            'parent_id' => 'nullable|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => trans('file-manager::file-manager.validation.folder_name_required'),
        ];

    }
}
