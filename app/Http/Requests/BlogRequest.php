<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            
            'title' =>   'required|min:4|max:100',
            'theme' =>   'required|min:2|max:30',
            'content' => 'required|min:10',
            'image'  =>  'required|image|mimes:jpeg,jpg,png,gif|max:10000' //max : 10000Kb = 10 mb
        ];
    }

    public function messages()
    {
        return [

            'title.required' => 'Veuillez donner un titre à votre article.',
            'title.min' => 'Le titre doit comporter au moins 4 caractères.',
    
            'theme.required' => 'Veuillez donner un theme à votre article.',
            'theme.min' => 'Le theme doit comporter au moins 2 caractères.',
    
            'content.required' => 'Veuillez remplir le contenu de votre article.',
            'content.min' => 'Le contenu de votre article doit comporter au moins 8 caractères.', 
            
            'image.required' =>  'Vous n\'avez pas séléctionné d\'image.',
            'image.mimes' =>  'Le format de votre image n\'est pas accepté.',
            'image.max' =>    'L\'image est trop volumineuse, choissiser une image de taille < 10Mo',
    
        ];

    }
}
