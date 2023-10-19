<?php

namespace App\StateMachine\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class StateHistory extends Model
{
    protected $table = 'state_history';

    public $fillable = [
        'actor_id',
        'statable_id',
        'statable_type',
        'transition',
        'from',
        'to',
    ];

    public function actor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'actor_id');
    }

    public function statable(): MorphTo
    {
        return $this->morphTo();
    }
}
