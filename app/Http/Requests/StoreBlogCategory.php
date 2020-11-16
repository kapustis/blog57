<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogCategory extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'title' => 'required|min:5|max:200',
			'slug' => 'max:200',
//			'description' => 'string|min:5|max:500',
			'parent_id' => 'required|integer|exists:blog_categories,id',
		];
	}
}
