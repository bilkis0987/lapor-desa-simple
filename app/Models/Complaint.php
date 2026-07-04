<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Complaint extends Model
{
    protected $fillable = [
        'category_id', 'complainant_name', 'complainant_phone',
        'complainant_email', 'title', 'description', 'location',
        'image', 'priority', 'status', 'admin_note',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(ComplaintComment::class);
    }
}

// Scope: byStatus byPriority byCategory
// TODO: Add resolvedStats scope