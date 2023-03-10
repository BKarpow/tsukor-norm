<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const ROLE_ADMIN = 42;
    const ROLE_USER = 42;

    public function isAdmin(): bool
    {
        return (int)$this->role === self::ROLE_ADMIN;
    }

    public function mySugar()
    {
        return $this->hasMany(MySugar::class, 'user_id', 'id');
    }

    public function sugarTargetRange()
    {
        return $this->hasMany(SugarTargetRange::class, 'user_id', 'id');
    }

    public function bloodPressure()
    {
        return $this->hasMany(BloodPressure::class, 'user_id', 'id');
    }

    public function medicaments()
    {
        return $this->hasMany(Medicament::class, 'user_id', 'id');
    }
}
