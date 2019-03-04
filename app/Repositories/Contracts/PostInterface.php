<?php
namespace App\Repositories\Contracts;

interface PostInterface extends RepositoryInterface
{
    public function getLatest();

    public function getSlide();
    
    public function getPopular();
    
    public function create($inputs);

    public function delete($postId);

    public function update($post, $inputs);
}