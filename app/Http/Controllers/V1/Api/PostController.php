<?php

namespace App\Http\Controllers\V1\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Exceptions\Api\UnknowException;
use App\Repositories\Contracts\TagInterface;
use App\Repositories\Contracts\PostInterface;

class PostController extends ApiController
{

    protected $postRepository;
    protected $tagRepository;

    public function __construct(
        PostInterface $postRepository,
        TagInterface $tagRepository)
    {
        parent::__construct();
        $this->postRepository = $postRepository;
        $this->tagRepository = $tagRepository;
        $this->middleware('auth:api',['only'=>['destroy','update','store']]);
    } 

    public function getLatest()
    {
        // return '123132';
        return $this->getData(function() {
            $this->compacts['data'] = $this->postRepository->getLatest();
        });
    }

    public function getSlide()
    {
        return $this->getData(function() {
            $this->compacts['data'] = $this->postRepository->getSlide();
        });
    }

    public function getPopular()
    {
        return $this->getData(function() {
            $this->compacts['data'] = $this->postRepository->getPopular();
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(
            'title',
            'content',
            'sub_category_id',
            'tags',
            'avatar_post'
        );
        // $data['user_id'] = $this->user->id;
        $data['user_id'] = 1;
        return $this->doAction(function () use ($data) {
            $data['tags'] = $this->tagRepository->getOrCreate($data['tags']);
            $this->compacts['data'] = $this->postRepository->create($data);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = $this->postRepository->findOrFail($id);

        if (!$this->user->can('manage', $post)) {
            throw new UnknowException('You do not have authorize to delete this post', UNAUTHORIZED);
        }

        return $this->doAction(function($post) {
            $this->compacts['result'] = $this->postRepository->delete($post);
        });
    }
}
