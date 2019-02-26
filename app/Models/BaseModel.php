<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{

    public function __construct($attributes = [])
    {
        parent::__construct($attributes);
    }

    public static function getTableName()
    {
        return with(new static)->getTable();
    }

    public function scopeFilters($query, $queryFilter)
    {
        return $queryFilter->apply($query);
    }
}
