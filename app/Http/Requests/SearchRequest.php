<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            
            'q' => 'required|min:2|max:120|alpha_num',
        ];
    }

    public function messages()
    {
        return [

            'q.required' => 'Veuillez remplir le champ de recherche',
            'q.min' => 'Le champ doit comporter au moins 2 caractères',
            'q.max' => 'Le champ peut comporter au maximum 120 caractères',
            'q.alpha_num' => 'Le champ doit comporter des caractères alphanumériques',
            
        ];
    }
}
