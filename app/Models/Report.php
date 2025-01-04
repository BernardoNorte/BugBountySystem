<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Program;

class Report extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'researcher_id',
        'program_id',
        'title',
        'description',
        'severity',
        'status',
        'proof_of_concept',
        'attachments',
        'steps_to_reproduce'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'researcher_id', 'id');
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'program_id', 'id');
    }

    protected function fullAttachmentURL(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->proof_of_concept ? asset('storage/attachments/' . $this->proof_of_concept) :
                    null;
            },
        );
    }
}
