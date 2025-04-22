<?php

namespace App\Http\Middleware;

use App\Models\MemberFolder;
use App\Models\UserFolder;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Illuminate\Support\Facades\DB;


class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user_id = $request->user() ? $request->user()->id : [];
        $member_id = $request->user('member') ? $request->user('member')->id : [];

        return [
            ...parent::share($request),
            'auth' => [
                'user'              => $request->user() ? $request->user()->only('name', 'role', 'email') : [],
                'member'            => $request->user('member') ? $request->user('member')->only('name', 'role', 'email', 'disk_space') : [],
                'user_folders'      => $user_id ? UserFolder::withoutTrashed()->where('user_id', '=', $request->user()->id)->get(['id', 'name']) : [],
                'member_folders'    => $member_id ? MemberFolder::withoutTrashed()->where('member_id', '=', $request->user('member')->id)->get(['id', 'name']) : [],
            ]
        ];
    }
}