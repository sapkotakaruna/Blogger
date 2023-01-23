<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreUserValidation extends FormRequest
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
            'name'            =>['required','max:20','string'],
            'email'           =>['required','email','unique:users'],
            'password'        =>['required','confirmed','min:8'],
            'main_photo'      =>['nullable','file','max:2048','mimes:jpg,jpeg,png,bmp,tiff'],
            'description'     =>['nullable','max:50'],
        ];
    }


}
