<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
 
class Post extends BaseModel
{
    use SoftDeletes;

    const ACTIVE = 1 ;
    const BLOCK  = 0;

    public function __construct($attributes = [])
    {
        parent::__construct($attributes);
    }

    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'sub_category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
