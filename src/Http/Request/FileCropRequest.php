<?php

namespace NguyenKhoi\FileManager\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class FileCropRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image_id' => 'required|integer',
            'crop_data' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'image_id.required' => trans('file-manager::file-manager.validation.image_required'),
            'image_id.integer' => trans('file-manager::file-manager.validation.image_id_integer'),
            'crop_data.required' => trans('file-manager::file-manager.validation.crop_data_required'),
        ];
    }
}
