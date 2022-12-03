<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class Author extends Model
{
    protected $guarded = [];

    public function getPhotoAttribute($value): ?string
    {
        if ($value)
            return Storage::disk('s3')->url($value);

        return null;
    }

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class)->withPivot(['royalty'])->withTimestamps();
    }
}
