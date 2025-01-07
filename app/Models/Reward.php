<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Report;

class Reward extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'researcher_id',
        'report_id',
        'amount',
        'created_by'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'researcher_id', 'id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function reports(): BelongsTo
    {
        return $this->belongsTo(Report::class, 'report_id', 'id');
    }
}
