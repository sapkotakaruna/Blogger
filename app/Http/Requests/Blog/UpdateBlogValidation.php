<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateBlogValidation extends FormRequest
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
            'title'          =>['required','max:150','unique:blogs,title,'.$this->id],
            'slug'           =>['required','unique:blogs,slug,'.$this->id],
            'sub_title'      =>['nullable'],
            'author'        =>['required'],
            'description'    =>['nullable','min:50'],
            'main_photo'     =>['nullable','file','max:2048'],
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
