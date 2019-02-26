<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends BaseModel
{
    use SoftDeletes;

    const TYPE_REVIEW = 2;
    const TYPE_SYSTEM = 1;
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const ROLE_OWNER = 'owner';
    const ROLE_MODERATOR = 'moderator';
    const ROLE_MEMBER = 'member';
    const ROLE_BLOCKED = 'blocked';

    public function __construct($attributes = [])
    {
        parent::__construct($attributes);
    }

    protected $fillable = [
        'id',
        'name',
        'type',
    ];

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function scopeOfRole($query, $type, $name)
    {
        return $query->whereType($type)->whereName($name);
    }
}
