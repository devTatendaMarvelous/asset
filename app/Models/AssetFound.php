<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class AssetFound extends Model
{
    protected $fillable = [
        'asset_id',
        'blacklist_id',
        'blacklist_type',
        'notes',
        'status',
    ];

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }

    public function blacklist(): MorphTo
    {
        return $this->morphTo();
    }
}
