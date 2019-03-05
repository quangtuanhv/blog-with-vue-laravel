<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;

class PostPolicy extends BasePolicy
{

    public function manage(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

}
