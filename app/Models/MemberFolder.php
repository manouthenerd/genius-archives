<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MemberFolder extends Model
{
    protected $guarded = ['id'];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }
}
