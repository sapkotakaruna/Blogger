<?php

namespace App\Http\Requests\AboutUs;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreAboutUsValidation extends FormRequest
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
            'name'           =>['required','max:150','unique:about_us'],
            'slug'           =>['required','unique:about_us'],
            'profile'        =>[ 'nullable','max:250'],
            'phone'          =>['nullable'],
            'email'          =>[ 'nullable'],
            'skill'          =>[ 'nullable'],
            'rank'           =>['nullable','numeric','gt:0'],
            'main_photo'     =>['file', 'max:2048', 'mimes:jpg,png,jpeg,gif,tif,bmp','required'],
            'description'    =>['nullable','min:10'],
            'status'         =>['nullable']
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->name)
        ]);
    }
}
