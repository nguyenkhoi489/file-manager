<?php

namespace NguyenKhoi\FileManager\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class FileUpdateRequest extends FormRequest
{
    public function authorize():bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|numeric',
            'name' => 'nullable|string',
            'alt' => 'nullable|string',
        ];
    }
}
