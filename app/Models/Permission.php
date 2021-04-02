<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Permission
 * @package App\Models
 * @property string name
 * @property string slug
 */
class Permission extends Model
{
    use HasFactory;

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_permissions')->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_permissions')->withTimestamps();
    }
}
