<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            
            'lname' => 'required|min:2|max:60|alpha',
            'fname' => 'required|min:2|max:60|alpha',
            'email' => 'required|email',
            'subject' => 'required|min:6',
            'message' =>  'required|min:10'

        ];
    }

    public function messages()
    {
       return [
         
         'lname.required' => 'Vous n\'avez pas rempli votre nom.',
         'lname.min' => 'Le nom doit comporter au moins 2 caractères.',
         'lname.alpha' => 'Le nom doit être entièrement composé de caractères alphabétiques.',

        
         'fname.required' => 'Vous n\'avez pas rempli votre prénom.',
         'fname.required' => 'Le nom doit comporter au moins 2 caractères.',
         'fname.alpha' => 'Le prénom doit être entièrement composé de caractères alphabétiques.',


         'email.required' => 'Vous n\'avez pas rempli votre Email.',
         'email.email' => 'Cette adresse mail n\'est pas valide ! ',
        
         'subject.required' => 'Vous n\'avez pas rempli le sujet.',
         'subject.min' => 'Le sujet doit comporter au moins 6 caractères.',

         'message.required' => 'Veuillez saisir un message.',
         'message.min' => 'Votre message doit comporter au moins 10 caractères.',

       ];

    }
}
