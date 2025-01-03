<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'created_by',
        'name',
        'description',
        'scope',
        'rewards_info',
        'is_active',
        'date_limit',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class, 'program_id', 'id');
    }

}
