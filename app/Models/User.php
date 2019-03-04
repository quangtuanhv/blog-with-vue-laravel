<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;
    const IN_ACTIVE = 0;
    const ACTIVE = 1;
    const BAN = 2;

    const ACTIVE_LINK_SEND = 'emails.active';

    protected $fillable = [
        'name',
        'email',
        'password',
        'birthday',
        'address',
        'phone',
        'avatar',
        'status',
        'token_confirm',
        'gender',
        'about',
        'deleted_at',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = ['deleted_at'];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
  
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    public function hasRole($role)
    {
        $roleId = Role::whereName($role)->first()->id;

        return $this->roles()->wherePivot('role_id', $roleId)->exists();
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            // Set filtering params before creating that it executes saving
            $user->token_confirm = Str::random(60);
            $user->birthday = is_null($user->birthday) ? null : Carbon::parse($user->birthday);
            $user->avatar = $user->avatar ?: config('settings.default_avatar');
            $user->gender = is_null($user->gender) ? 0 :$user->gender;
            $user->status = 0;
        });
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Post', 'user_id', 'id');
    }
}