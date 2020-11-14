<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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

            'title' => 'required|min:4|max:50',
            'subtitle' => 'required|min:3|max:20',
            'stock' => 'required|integer|min:1',
            'price' => 'required',
            'category_id' => 'required|integer',
            'image' =>  'required|image|mimes:jpeg,jpg,png,gif|max:10000', //max : 10000Kb = 10 mb
            'description' => 'required|min:8'
        ];
    }

    public function messages()
    {
        return [

            'title.required' => 'Vous n\'avez pas rempli le nom du produit.',
            'title.min' => 'Le nom du produit doit comporter au moins 4 caractères.',

            'subtitle.required' => 'Vous n\'avez pas rempli le sous-titre.',
            'subtitle.min' => 'Le sous-titre doit comporter au moins 3 caractères.',

            'stock.required' => 'Vous n\'avez pas rempli le stock.',
            'stock.integer' => 'Le stock doit etre un entier.',
            'stock.min' => 'Le stock doit être supérieur à 0.',

            'price.required' => 'Vous n\'avez rempli le prix du produit.',
            'price.float' => 'Le prix doit être un réel positif.',

            'category_id.required' => 'Vous n\'avez pas choisi de catégorie.',
            'category_id.integer' => 'Veuillez choisir une des catégories présente.',

            'description.required' => 'Vous n\'avez pas rempli la description du produit.',
            'description.min' => 'La description doit comporter au moins 8 caractères.', 
            
            'image.required' =>  'Vous n\'avez pas séléctionné d\'image.',
            'image.mimes' =>  'Le format de votre image n\'est pas accepté.'
        ];
    }

}
