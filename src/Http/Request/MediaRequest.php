<?php

namespace NguyenKhoi\FileManager\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest
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
            'view_in' => 'nullable|string',
            'sort_by' => 'nullable|string',
            'folder_id' => 'nullable|string',
            'search' => 'nullable|string',
            'load_more' => 'required',
            'paged' => 'required|integer',
            'posts_per_page' => 'required|integer',
            'ids' => 'nullable',
            'type' => 'nullable',
        ];
    }
}
