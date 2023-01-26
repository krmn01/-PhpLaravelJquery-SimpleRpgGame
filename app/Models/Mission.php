<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
        'startTime',
        'endTime',
        'exp',
        'gold',
        'status', /// 0-w trakcie, 1-zakonczona mozna usuwac
        'user_id'
    ];

    protected $table = 'missions';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
