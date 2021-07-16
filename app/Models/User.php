<?php

namespace App\Models;

use App\Traits\HasRolesAndPermissions;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @package App\Models
 * @property int id
 * @property string name
 * @property mixed|string email
 * @property \Illuminate\Support\Carbon|mixed email_verified_at
 * @property mixed|string password
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Linking the Auth model to the Post model, allows you to get all the user's posts
     * Связь модели Auth с моделью Post, позволяет получить все посты пользователя
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BlogPost::class);
    }

    /**
     * Linking the Auth model to the Comment model, allows you to get all the user's comments
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BlogComment::class);
    }

}
