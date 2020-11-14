<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            
            'name' => 'required|min:6|max:100',
            'date' => 'required|date',
            'nbrPlaces' => 'required|integer|min:1',
            'description' => 'required|min:8',
            'image' =>  'required|image|mimes:jpeg,jpg,png,gif|max:10000' //max : 10000Kb = 10 mb
        ];
    }

    public function messages()
    {
        return [

            'name.required' => 'Vous n\'avez pas rempli le nom de l\'évènement.',
            'name.min' => 'Le titre doit comporter au moins 6 caractères.',

            'date.required' => 'Vous n\'avez pas rempli la date de l\'évènement.',
            'date.date' => 'Veuillez respecter le format de la date.',

            'nbrPlaces.required' => 'Vous n\'avez rempli le nombre de places de l\'évènement.',
            'nbrPlaces.integer' => 'Le nombre de places doit être un entier.',
            'nbrPlaces.min' => 'Le nombre de places doit être supérieur à 0.',

            'description.required' => 'Vous n\'avez pas rempli la description de l\'évènement.',
            'description.min' => 'La description doit comporter au moins 8 caractères.', 
            
            'image.required' =>  'Vous n\'avez pas séléctionné d\'image.',
            'image.mimes' =>  'Le format de votre image n\'est pas accepté.',
            'image.max' =>    'L\'image est trop volumineuse, choissiser une image de taille < 10Mo',

        ];
    }
}
