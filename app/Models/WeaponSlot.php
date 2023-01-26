<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WeaponSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'dmg',
        'imgPath',
        'value',
        'user_id'
    ];

    protected $table = 'weapon_slots';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
