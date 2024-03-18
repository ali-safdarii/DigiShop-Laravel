<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class PostCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {

        if ($this->isMethod('post')){
            return [
                'name' => 'required',
                'description' => 'required|max:500|min:5',
                'slug' => 'nullable',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'nullable',
                'image' => 'required',
            ];
        }else{
            return [
                'name' => 'required',
                'description' => 'required|max:500|min:5',
                'slug' => 'nullable',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'nullable',
                'image' => '',
            ];
        }

    }
}
