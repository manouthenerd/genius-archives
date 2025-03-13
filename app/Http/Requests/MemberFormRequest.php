<?php

namespace App\Http\Requests;

use App\Models\Member;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class MemberFormRequest extends FormRequest
{

    protected $free_space = null;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return request()->user()->role == 'administrateur';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = request()->user();

        $user_disk_space = $user->access_key->disk_space;

        $user_members_disk_space = Member::where('user_id', '=', $user->id)->sum('disk_space');

        $free_space = $user_disk_space - $user_members_disk_space;

        $this->free_space = $free_space;

        return [
            'name'          => ['required', 'string'],
            'email'         => ['required', 'email', 'lowercase', 'string', 'unique:members,email'],
            'password'      => ['required', Password::default()],
            'disk_space'    => ['required', 'gt:0', "lte:$free_space"],
            'can_view_private_folders' => ['boolean']
        ];
    }

    public function attributes()
    {
        return [
            'disk_space' => "quota d'espace"
        ];
    }

    public function messages()
    {
        return [
            'disk_space.lte' => "Le quota d'espace est supérieur à votre espace libre qui est de $this->free_space Go"
        ];
    }
}
// TODO: Prendre en compte la taille des fichiers uploadé pour déterminer l'espace restante
