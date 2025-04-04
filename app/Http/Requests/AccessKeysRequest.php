<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccessKeysRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'key'           => ['required', 'string', 'min:36', 'max:36', 'uuid', 'unique:access_keys,key'],
            'disk_space'    => ['required', 'integer', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            'key.required'          =>  'La valeur de la clé est requise',
            'key.string'            =>  'La valeur attendue doit être une chaîne de caractères',
            'key.min'               =>  'La longueur de la clé doit être de :min caractères',
            'key.max'               =>  'La longueur de la clé doit être de :max caractères',
            'key.uuid'              =>  'La clé d\'accès fournie est incorrecte',
            'key.unique'            =>  'Cette clé d\'accès existe déjà',
            'disk_space.required'   => 'Ce champ est requis',
            'disk_space.integer'    => 'Veuillez entrer une valeur numérique',
            'disk_space.numeric'    => 'Veuillez entrer une valeur numérique',
        ];
    }
}
