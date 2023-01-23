<?php

namespace App\Http\Requests\AboutUs;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateAboutUsValidation extends FormRequest
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
            'name'          =>['required','max:150','unique:about_us,name,'.$this->id],
            'slug'          =>['required','unique:about_us,slug,'.$this->id],
            'profile'      =>[ 'nullable'],
            'email'      =>[ 'nullable'],
            'phone'      =>[ 'nullable'],
            'skill'      =>[ 'nullable'],
            'rank'           =>['nullable','numeric','gt:0'],
            'main_photo'     =>['nullable','file','max:2048'],
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
