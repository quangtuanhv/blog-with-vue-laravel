<?php

namespace App\Repositories\Eloquent;

use Notification;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Role;
use App\Jobs\SendEmail;
use App\Notifications\MakeFriend;
// use App\Traits\Common\UploadableTrait;
use App\Exceptions\Api\UnknowException;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Repositories\Contracts\UserInterface;

class UserRepository extends BaseRepository implements UserInterface
{
    use DispatchesJobs;
    //  UploadableTrait;

    public function model()
    {
        return User::class;
    }

    public function active($token)
    {
        $user = $token ? $this->where('token_confirm', $token)->first() : false;

        if (!$user) {
            return false;
        }

        $this->update($user->id, [
            'status' => User::ACTIVE,
            'token_confirm' => null,
        ]);

        return $user;
    }

    public function register($inputs, $roleId)
    {
        $user = $this->create($inputs);

        if (!$user) {
            throw new UnknowException('Had errors while processing');
        }

        $user->roles()->attach($roleId);

        // Send email active to user
        $info = [
            'email' => $inputs['email'],
            'subject' => trans('emails.active_subject'),
        ];

        $fields = [
            'object' => $user->name,
            'linkActive' => action('Frontend\UserController@active', $user->token_confirm),
        ];

        $this->dispatch(new SendEmail($info, User::ACTIVE_LINK_SEND, $fields));

        return true;
    }
}
