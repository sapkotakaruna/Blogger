<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreBlogValidation extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'          =>['required','max:150','unique:blogs'],
            'slug'           =>['required','unique:blogs'],
            'sub_title'      =>['nullable'],
            'author'        =>['required'],
            'description'    =>['nullable','min:50'],
            'main_photo'     =>['file', 'max:2048', 'mimes:jpg,png,jpeg,gif,tif,bmp','required'],
            'rank'           =>['nullable','numeric','gt:0'],
            'status'         =>['nullable']
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->title)
        ]);
    }
}
