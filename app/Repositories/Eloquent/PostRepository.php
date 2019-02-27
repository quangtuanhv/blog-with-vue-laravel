<?php

namespace App\Repositories\Eloquent;

use DB;
use App\Models\Post;
use App\Exception\UnknowException;
use App\Exception\NotFoundException;
use App\Repositories\Contracts\PostInterface;

class PostRepository extends BaseRepository implements PostInterface
{
    public function model()
    {
        return Post::class;
    }

    public function getLatest()
    {
        // return config('settings.paginate.latest_home');

        $listPost = DB::table('posts')->orderBy('updated_at','desc')->paginate(config('settings.paginate.latest_home'));
        
        return $listPost ;
    }

    public function getSlide()
    {
        $listPost = DB::table('posts')->orderBy('updated_at','desc')->take(3)->get();
        
        return $listPost ;
    }
    
    public function getPopular()
    {
        $listPost = DB::table('posts')->orderBy('updated_at','desc')->take(3)->get();
        
        return $listPost ;
    }

    public function create($inputs)
    {
        if (is_null($inputs) || !is_array($inputs))
        {
            throw new UnknowException ('Inputs is null or not an array');
        }

        $post = parent::create($inputs);

        if (!$post) 
        {
            throw new NotFoundException("Can't create a post");   
        }

        
        return $post;
    }
}
