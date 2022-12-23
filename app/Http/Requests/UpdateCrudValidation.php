<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCrudValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'=>        ['required','max:150'],
            'rank'=>         ['required','numeric','gt:0'],
            'main_photo'=>   ['nullable','file','max:2048'],
            'description'=>  ['required','min:10'],
            'status'=>       ['nullable'],
        ];
    }
}
