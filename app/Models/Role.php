<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permissions_roles');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'roles_users');
    }
}
