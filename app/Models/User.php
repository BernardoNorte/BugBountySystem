<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Program;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Report;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo_filename'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function programs(): HasMany
    {
        return $this->hasMany(Program::class, 'created_by', 'id');
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class, 'researcher_id', 'id');
    }

    protected function fullPhotoUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->photo_filename ? asset('storage/photos/' . $this->photo_filename) :
                    asset('storage/img/avatar_unknown.png');
            },
        );
    }
}
