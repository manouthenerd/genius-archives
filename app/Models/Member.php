<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\MemberFactory> */
    use SoftDeletes, HasFactory, Notifiable, CanResetPassword;

    protected $guarded = [];

    protected $guard = 'member';

    protected function casts(): array
    {
        return ['password'  => 'hashed'];
    }
}