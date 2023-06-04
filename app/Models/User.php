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
        'type_diabet',
        'use_insulin',
        'use_tablet',
        'avatar',
        'avatar_original'
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
    const ROLE_USER = 1;

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

    public function hba1c()
    {
        return $this->hasMany(HbA1c::class, 'user_id', 'id');
    }

    public function insulin()
    {
        return $this->hasMany(Insulin::class, 'user_id', 'id');
    }

    public function insulinLog()
    {
        return $this->hasMany(InsulinTake::class, 'user_id', 'id');
    }

    public function medTake()
    {
        return $this->hasMany(MedicamentTake::class, 'user_id', 'id');
    }

    public function keton()
    {
        return $this->hasMany(Keton::class, 'user_id', 'id');
    }

    public function config()
    {
        return $this->hasMany(Config::class, 'user_id', 'id');
    }

    public function history()
    {

        return $this->hasMany(UserWriteHistory::class, 'user_id', 'id');
    }
}
