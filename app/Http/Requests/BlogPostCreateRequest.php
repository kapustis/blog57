<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:5|max:200|unique:blog_posts',
            'slug' => 'max:200',
            'content_raw' => 'required|string|min:5|max:10000',
            'category_id' => 'required|integer|exists:blog_categories,id',
        ];
    }

    /**
     * Get the error messages for the defined valida
     * @return array|string[]
     */
    public function messages()
    {
        //return parent::messages(); // TODO: Change the autogenerated stub
        return [
            'title.required' => 'Введите загаловок статьи',
            'content_raw' => 'Минимальная длина статьи [:min] символов'
        ];
    }

    public function attributes()
    {
        //return parent::attributes(); // TODO: Change the autogenerated stub
        return [
            'title' => 'Заголовок'
        ];
    }
}
