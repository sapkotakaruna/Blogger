<?php

namespace App\Http\Requests\Skill;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreSkillValidation extends FormRequest
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
            'title'          =>['required','max:150','unique:skills'],
            'slug'           =>['required','unique:skills'],
            'percent'      =>['required','numeric','gt:0','lt:100'],
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
