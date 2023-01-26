<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fight extends Model
{
    use HasFactory;

    protected $fillable = [
        'player1Hp',
        'player2Hp',
        'player1MaxHp',
        'player2MaxHp',
        'player1DmgMin',
        'player2DmgMin',
        'player1DmgMax',
        'player2DmgMax',
        'player2lvl',  /// do wyliczania ew. nagrody
        'playerAttacks',
        'user_id'
    ];

    protected $table = 'fights';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
