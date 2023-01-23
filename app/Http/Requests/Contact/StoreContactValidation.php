<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreContactValidation extends FormRequest
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
            'name'          =>['required','max:150','unique:contacts'],
            'slug'           =>['required','unique:contacts'],
            'email'          =>['required'],
            'subject'        =>['nullable'],
            'message'        =>['nullable'],
            'rank'           =>['nullable','numeric','gt:0'],
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
