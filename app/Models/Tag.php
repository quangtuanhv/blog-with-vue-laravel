<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends BaseModel
{
    use SoftDeletes;

    public function __construct($attributes = [])
    {
        parent::__construct($attributes);
    }

    protected $fillable = [
        'id',
        'name',
    ];

    protected $dates = ['deleted_at'];

    public function posts()
    {
        return $this->belongsToMany(Campaign::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
