<?php

namespace App\Http\Requests\Trial;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTrialValidation extends FormRequest
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
            'name'=>        ['required','max:150'],
            'sub_title'      =>[ 'nullable'],
            'rank'=>         ['required','numeric','gt:0'],
            'main_photo'=>   ['nullable','file','max:2048'],
            'description'=>  ['required','min:10'],
            'status'=>       ['nullable'],
        ];
    }
}
