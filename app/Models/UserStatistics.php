<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserStatistics extends Model
{
    use HasFactory;

    protected $fillable = [
        'level',
        'currentExp',
        'intelligence',
        'strength',
        'vitality',
        'gold',
        'avatarPath',
        'user_id'
    ];

    protected $table = 'user_statistics';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
