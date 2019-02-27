<?php

namespace App\Http\Controllers\V1\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Repositories\Contracts\PostInterface;

class PostController extends ApiController
{

    protected $postRepository;

    public function __construct(PostInterface $postRepository)
    {
        parent::__construct();
        $this->postRepository = $postRepository;
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
        $data = $request->all();
        return $this->doAction(function () use ($data) {
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
        //
    }




}
