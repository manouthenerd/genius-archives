<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberFormRequest;
use App\Http\Requests\UpdateMemberFormRequest;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Member;
use Illuminate\Support\Arr;


class MemberController extends Controller
{
    public function index(): Response
    {
        $members = request()->user()
            ->members
            ->map(fn ($member) => [
                'id' => $member->id, 
                'name' => $member->name, 
                'email' => $member->email,
                'disk_space' => $member->disk_space,
                'can_view_private_folders'  => $member->can_view_private_folders
            ]);

        return Inertia::render('Member/Members', ['members' => $members]);
    }

    public function store(MemberFormRequest $request)
    {
        $validated = $request->validated();

        $member = Arr::add($validated, 'user_id', $request->user()->id);

        Member::create($member);

        return redirect()->back()->with('status', "Membre créé avec succès");
    }

    public function show(Member $id)
    {
        $member = $id->only('id', 'name', 'email', 'disk_space', 'user_id');


        return Inertia::render('Member/EditMember', ['member' => $member]);
    }
        
    public function update(UpdateMemberFormRequest $request)
    {
        $member = Member::find($request->input('id'));

        $member->update([
            'name'  => $request->input('name'),
            'email'  => $request->input('email'),
            'disk_space'  => $request->input('disk_space'),
        ]);

        $member->save();

        if($member->wasChanged('email')) {
            $member->email_verified_at = null;
            $member->save();
        }

        return redirect()->back()->with('status', 'Modification effectuée avec succès.');

    }

    public function restore($id)
    {
        // Récupérer le modèle s'il existe
        $member = Member::onlyTrashed()->findOrFail($id);

        $member->restore();

    }

    public function delete($id)
    {
        Member::find($id)->delete();
    }

    public function destroy($id)
    {
        
        $member = Member::onlyTrashed()->find($id);

        $member->forceDelete();
    }
}