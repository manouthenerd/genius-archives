<?php

namespace App\Http\Requests;

use App\Models\Member;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateMemberFormRequest extends FormRequest
{
    protected $free_space = null;

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
    public function rules(Request $request): array
    {

        $user = request()->user();

        $member = Member::find($request->input('id'));

        $user_disk_space = $user->access_key->disk_space;

        $user_members_disk_space = Member::where('user_id', '=', $user->id)
                         ->where('id', '!=', $member->id)
                         ->sum('disk_space');

        $free_space = $user_disk_space - $user_members_disk_space;

        $this->free_space = $free_space;

        return [
            'name'          => ['required', 'string'],
            'email'         => ['required', 'email', 'lowercase', 'string'],
            'disk_space'    => ['required', 'gt:0', "lte:$free_space"],
            'email'         => ['required', 'email', 'lowercase', 'string', Rule::unique('members', 'email')->ignore($member->id)],
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
