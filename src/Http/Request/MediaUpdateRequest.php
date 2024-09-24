<?php

namespace NguyenKhoi\FileManager\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class MediaUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'id' => 'required',
            'name' => 'required|string',
            'is_folder' => 'required',
        ];
    }
}
