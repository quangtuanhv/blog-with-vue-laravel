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
        
        $data = [
            'title' => $inputs['title'],
            'content' => $inputs['content'],
            'user_id' => $inputs['user_id'],
            'sub_category_id' => $inputs['sub_category_id'],
            'avatar_post' => $inputs['avatar_post']
        ];

        $data['published'] = false;
        $data['number_of_likes'] = 0;
        $data['number_of_comments'] = 0;

        $post = parent::create($data);

        if (!$post) 
        {
            throw new NotFoundException("Can't create a post");   
        }

        if ($inputs['tags'] && is_array($inputs['tags'])) 
        {
            $post->tags()->attach($inputs['tags']['old']);
            $post->tags()->createMany($inputs['tags']['new']);
        }
        
        return $post;
    }
}
