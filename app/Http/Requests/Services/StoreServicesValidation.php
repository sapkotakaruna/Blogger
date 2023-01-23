<?php

namespace App\Http\Requests\Services;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreServicesValidation extends FormRequest
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
            'title'          =>['required','max:150','unique:services'],
            'slug'           =>['required','unique:services'],
            'main_photo'     =>['file', 'max:2048', 'mimes:jpg,png,jpeg,gif,tif,bmp','required'],
            'description'    =>['nullable','min:10'],
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
