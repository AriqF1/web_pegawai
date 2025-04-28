<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LeaveApproval extends Model
{
    protected $fillable = [
        'leave_id',
        'approver_id',
        'status',
        'notes',
    ];

    public function leave(): BelongsTo
    {
        return $this->belongsTo(Leave::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approver_id');
    }
}
