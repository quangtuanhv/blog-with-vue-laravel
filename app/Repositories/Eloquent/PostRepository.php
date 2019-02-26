<?php

namespace App\Repositories\Eloquent;

use App\Models\Post;

class PostRepository extends BaseRepository implements PostInterface
{
    public function model()
    {
        return Post::class;
    }

    public function getLatest()
    {
        return 0;
    }

    public function getSlide()
    {
        return 0;
    }
    
    public function getPopular()
    {
        return 0;
    }
}
