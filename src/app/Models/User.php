<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'name',
        'email',
        'email_verified_at',
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

    const ROLE_ADMIN = 1;
    const ROLE_OWNER = 2;
    const ROLE_GENERAL = 3;

    public static function getUsers()
    {
        $query = self::select(
            'users.id',
            'roles.role_name as role_name',
            'users.name',
            'users.email',
            'users.password',
            'users.created_at'
        )
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->orderBy('users.id', 'asc');

        return $query;
    }

    public static function deleteOwner($userId)
    {
        return self::destroy($userId);
    }
}
