<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function portfolios()
    {
        return $this->hasManyThrough(Portfolio::class, Profile::class);
    }

    public function experiences()
    {
        return $this->hasManyThrough(Experience::class, Profile::class);
    }

    public function educations()
    {
        return $this->hasManyThrough(Education::class, Profile::class);
    }

    public function certifications()
    {
        return $this->hasManyThrough(Certification::class, Profile::class);
    }
}

