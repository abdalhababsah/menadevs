<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'task_description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'language_id' => 'required|exists:languages,id',
            'max_review_level' => 'nullable|integer|min:1|max:10',
            'dimensions' => 'required|array',
            'dimensions.*' => 'required|string|max:255',
            'task_count' => 'nullable|integer|min:1|max:100',
        ];
    }
}