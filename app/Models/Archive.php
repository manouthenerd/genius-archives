<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Archive extends Model
{
    /** @use HasFactory<\Database\Factories\ArchiveFactory> */
    use SoftDeletes, HasFactory;

    protected $guarded = [];

    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class);
    }
}
