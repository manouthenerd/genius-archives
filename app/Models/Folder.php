<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Folder extends Model
{
    /** @use HasFactory<\Database\Factories\FolderFactory> */
    use SoftDeletes, HasFactory;

    protected $guarded = [];

    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }

}
