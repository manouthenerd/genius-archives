<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\Send2faVerificationCode;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\MemberFactory> */
    use SoftDeletes, HasFactory, Notifiable, CanResetPassword;

    protected $guarded = [];

    protected $guard = 'member';

    public function folders(): HasMany
    {
        return $this->hasMany(MemberFolder::class);
    }

    protected function casts(): array
    {
        return ['password'  => 'hashed'];
    }
}