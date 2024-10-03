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
            'image_id.required' => 'The image id field is required.',
            'image_id.integer' => 'The image id field must be an integer.',
            'crop_data.required' => 'The crop data field is required.',
        ];
    }
}
